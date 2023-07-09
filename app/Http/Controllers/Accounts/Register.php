<?php

namespace App\Http\Controllers\Accounts;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\AccountCreation;
use App\Models\PasswordReset;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\StudentMember;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class Register extends Controller
{
    public function index()
    {
        $page_title = 'Register';

        return view('auth.register', [
            'page_title' => $page_title,
        ]);
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        $user = User::where('username', $validatedData['username'])->first();

        if ($user) {
            return redirect()
                ->back()
                ->withInput()
                ->with(['error' => 'This account already exists.']);
        }


        if (str_ends_with($validatedData['email'], '@strathmore.edu')) {

            $studentEmailPrefix = strtolower($validatedData['first_name']) . '.' . strtolower($validatedData['last_name']);

            $staffEmailPrefix = strtolower(substr($validatedData['first_name'], 0, 1)) . strtolower($validatedData['last_name']);

            // Extract the email prefix from the validated email
            $emailPrefix = strtolower(substr($validatedData['email'], 0, strpos($validatedData['email'], '@')));

            // Check if the email belongs to a student
            if ($studentEmailPrefix === $emailPrefix) {
                // Perform actions specific to student email

                // Create a new user
                $user = new User;
                $user->first_name = $validatedData['first_name'];
                $user->last_name = $validatedData['last_name'];
                $user->username = $validatedData['username'];
                $user->email = $validatedData['email'];
                $user->password = Hash::make('Password@2030.');

                // Assign Role
                $userRole = Role::where('name', 'Student')->first();
                $user->assignRole($userRole);

                // Generate an email password reset token
                $token = Str::random(64);

                // Insert email and token in password resets table
                $passwordResetToken = PasswordReset::where('email', $validatedData['email'])->first();
                if ($passwordResetToken) {

                    PasswordReset::where('email', $validatedData['email'])->update([
                        'email' => $validatedData['email'],
                        'token' => $token,
                    ]);
                } else {

                    PasswordReset::create([
                        'email' => $validatedData['email'],
                        'token' => $token,
                    ]);
                }

                // Save the new user and add to the sstudents table
                if($user->save()){

                    $student = new StudentMember();
                    $student->user_id = $user->id;
                    $student->student_id = $user->username;
                    $student->first_name = $user->first_name;
                    $student->last_name = $user->last_name;
                    $student->email = $user->email;

                    $student->save();
                }

                // Send password reset link email with the token
                if (Mail::to($user->email)->queue(new AccountCreation($user, $token))) {

                    return redirect()
                        ->back()
                        ->with(['success' =>'Account has been registered successfully. An email with the account activation link was sent to ' . $user->email]);
                } else {

                    return redirect()
                        ->back()
                        ->with(['error' => 'There was an error sending the email. Please try again. You can try using the password reset link to access your account.']);
                }



            } elseif ($staffEmailPrefix === $emailPrefix) {
                // Perform actions specific to staff email



            }else{
                return redirect()
                ->back()
                ->withInput()
                ->with(['error' => 'You entered an invalid Strathmore Email']);

            }
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with(['error' => 'You entered an invalid Strathmore Email']);
        }
    }
}
