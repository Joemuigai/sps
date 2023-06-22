<?php

namespace App\Http\Controllers\Accounts;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Models\User as ModelsUser;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;


class Login extends Controller
{
    public function index()
    {
        $page_title = 'Login';

        return view('auth.login', [
            'page_title' => $page_title,
        ]);
    }



    // Login Attempt
    public function login2(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
        ]);

        $user = User::where('username', $validatedData['username'])->first();

        if (!$user) {
            return redirect()
                ->back()
                ->withInput($request->only('username', 'remember'))
                ->with(['error' => 'This account does not exist']);
        }

        if (!Hash::check($validatedData['password'], $user->password)) {
            return redirect()
                ->back()
                ->withInput($request->only('username', 'remember'))
                ->with(['error' => 'Invalid credentials! Please try again']);
        }

        if ($user->status === 'inactive') {
            return redirect()
                ->back()
                ->withInput($request->only('username', 'remember'))
                ->with(['error' => 'Your account is currently deactivated']);
        }

        if ($user->status === 'suspended') {
            return redirect()
                ->back()
                ->withInput($request->only('username', 'remember'))
                ->with(['error' => 'This account is suspended. Please contact administrator']);
        }

        if ($user->status === 'locked') {
            return redirect()
                ->back()
                ->withInput($request->only('username', 'remember'))
                ->with(['error' => 'The system access is currently locked.']);
        }

        Auth::login($user, true);

        // Store the user ID in the session
        session([
            'user_id' => Auth::id(),
            'email' => $user->email,
            'student_id' => $user->student_id,
            'username' => $user->username,
            'team_id' => $user->team_id,
            'mobile' => $user->mobile,
            'name' => $user->first_name . ' ' . $user->last_name,
            'role' => $user->getRoleNames()->first(), // Get the first role name associated with the user
            'lastActivity' => time(),
        ]);

        if (auth()->user()->hasRole('Administrator')) {
            return redirect()
                ->route('admin.dashboard')
                ->with(['success' => 'You have successfully logged in as an Administrator.']);
        }elseif (auth()->user()->hasRole('Sports Admin')) {
            return redirect()
                ->route('sadmin.dashboard')
                ->with(['success' => 'You have successfully logged in as an Sports Administrator.']);
        }elseif (auth()->user()->hasRole('Team Coach')) {
            return redirect()
                ->route('coach.dashboard')
                ->with(['success' => 'You have successfully logged in as an the Team Coach']);
        }

    }


    // Forgot Password Page

    public function forgotPassword()
    {
        $page_title = 'Forgot Password';

        return view('auth.forgot_password', [
            'page_title' => $page_title,
        ]);
    }

    // Submit forgot password email and send password reset link

    public function sendResetPasswordLink(Request $request)
    {
        // Validate email input
        $request->validate([
            'email' => 'required|email',
        ]);


        // Check if user is currently registered
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()
                ->back()
                ->withInput($request->only('email'))
                ->with(['error' => 'This email is currently not registered.']);
        } else {
            // Generate an email password reset token
            $token = Str::random(64);

            // Insert email and token in password resets table
            $passwordResetToken = PasswordReset::where('email', $request->email)->first();
            if($passwordResetToken){

                PasswordReset::where('email', $request->email)->update([
                    'email' => $request->email,
                    'token' => $token,
                ]);

            }else{

                PasswordReset::create([
                    'email' => $request->email,
                    'token' => $token,
                ]);

            }


            // Send password reset link email with the token
            if (Mail::send('emails.password-reset', ['token' => $token, 'user' => $user], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject("Reset Password Notification");
            })) {

                return redirect()
                    ->back()
                    ->with(['success' => 'An email with the password reset link was sent to ' . $request->email]);
            } else {

                return redirect()
                    ->back()
                    ->with(['error' => 'There was an error sending the email. Please try again. ']);
            }
        }
    }



    // Password Reset Page

    public function resetPassword($token)
    {
        $page_title = 'Reset Password';

        $user = PasswordReset::where('token', $token)->first();

        if(! $user){

            return redirect()
                    ->back()
                    ->with(['error' => 'Password reset token is invalid!']);

        }

        $email = $user->email;

        return view('auth.reset_password', [
            'page_title' => $page_title,
            'token' => $token,
            'email' => $email,
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);


        $user = ModelsUser::where('email', $request->email)->first();
        if (!$user) {

            return redirect()
                ->back()
                ->with(['error' => 'This account does not exist']);
        } else {

            $user->password = Hash::make($request->password);


            if($user->save()){

                PasswordReset::where('email', $user->email)->delete();

            }

            // Return a success message
            $success_msg = 'Password for account user ' . $user->first_name . ' ' . $user->last_name . ' has been reset successfully. You can now sign in to access your account.';

            return redirect()->route('account.login')->with('success', $success_msg);
        }
    }



    // Logout

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('account.login')
            ->with(['success' =>  'You have successfully logged out'])
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    }



}
