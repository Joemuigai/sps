<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Mail\VerificationEmail;
use App\Models\User as ModelsUser;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Passwords\PasswordBrokerManager;


class SystemUsers extends Controller
{
    public function index()
    {
        $page_title = 'System Users';

        $system_users = ModelsUser::all();

        $totalUsers = ModelsUser::count();
        $totalActiveUsers = ModelsUser::where('status', 'activated')->count();
        $totalInactiveUsers = ModelsUser::where('status', 'inactive')->count();
        $totalSuspendedUsers = ModelsUser::where('status', 'suspended')->count();


        return view('admin.system_users', [
            'page_title' => $page_title,
            'system_users' => $system_users,
            'totalUsers' => $totalUsers,
            'totalActiveUsers' => $totalActiveUsers,
            'totalInactiveUsers' => $totalInactiveUsers,
            'totalSuspendedUsers' => $totalSuspendedUsers,
        ]);
    }

    public function create()
    {
        $page_title = 'Add System User';

        $roles = Role::all();

        return view('admin.add_system_user', [
            'page_title' => $page_title,
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        // Validate the user's inputs
        $request->validate([
            'first_name' => 'required|string',
            'username' => 'required',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|string',
            'role' => 'required|string',

        ]);

        // Assign the default password
        $password = "Password@2030.";

        // Encrypt the password using Laravel's built-in Hash facade
        $encryptedPassword = Hash::make($password);

        // Create a new user
        $user = new ModelsUser;
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile');
        $user->password = $encryptedPassword;


        // Assign Role
        $role = $request->input('role');
        $userRole = Role::where('name', $role)->first();
        $user->assignRole($userRole);



        // Generate an email password reset token
        $token = Str::random(64);

        // Insert email and token in password resets table
        $passwordResetToken = PasswordReset::where('email', $request->email)->first();
        if ($passwordResetToken) {

            PasswordReset::where('email', $request->email)->update([
                'email' => $request->email,
                'token' => $token,
            ]);
        } else {

            PasswordReset::create([
                'email' => $request->email,
                'token' => $token,
            ]);
        }


        // Send password reset link email with the token
        if (Mail::send('emails.verify-email', ['token' => $token, 'user' => $user], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject("Account Creation Notification");
        })) {

            // Save the new user
            $user->save();

            return redirect()
                ->route('admin.systemUsers')
                ->with(['success' => $user->first_name . ' ' . $user->last_name . ' has been registered successfully. An email with the password reset link was sent to ' . $user->email]);
        } else {

            return redirect()
                ->back()
                ->with(['error' => 'There was an error sending the email. Please try again. ']);
        }
    }

    public function view($id)
    {
        // Retrieve the product based on the member id
        $user = ModelsUser::where('id', $id)->first();

        // Return a 404 response if the product was not found
        if (!$user) {
            abort(404);
        }

        $page_title = $user->first_name . ' ' . $user->last_name;

        return view('admin.view_system_user', [
            'user' => $user,
            'page_title' => $page_title,
        ]);
    }

    // public function update(Request $request, $id)
    // {
    //     // Validate the user's inputs
    //     $request->validate([
    //         'first_name' => 'required|string',
    //         'last_name' => 'required|string',
    //         'email' => 'required|email',
    //         'mobile' => 'nullable|string',
    //         'username' => 'required|string',
    //         'role_id' => 'required|exists:roles,id',
    //     ]);

    //     // Create a new club head
    //     $user = ModelsUser::find($id);
    //     $user->first_name = $request->input('first_name');
    //     $user->last_name = $request->input('last_name');
    //     $user->email = $request->input('email');
    //     $user->mobile = $request->input('mobile');
    //     // $user->student_id = $request->input('username');
    //     $user->username = $request->input('username');
    //     $user->role_id = $request->input('role_id');
    //     $user->status = $request->input('status');

    //     // Save the new user
    //     $user->save();

    //     if($user->role_id == 3){

    //         $club_id = $user->club_id;
    //         $club_head  = ClubHead::where('club_id', $club_id)->first();
    //         $club_head->first_name = $request->input('first_name');
    //         $club_head->last_name = $request->input('last_name');
    //         $club_head->email = $request->input('email');
    //         $club_head->mobile = $request->input('mobile');
    //         $club_head->student_id = $request->input('username');
    //         // $club_head->role_id = $request->input('role_id');
    //         // $club_head->status = $request->input('status');

    //         // Update Club Head
    //         $club_head->save();


    //     }

    //     // Return a success message
    //     $success_msg = $user->first_name . ' ' . $user->last_name .' details have been updated successfully.';

    //     return redirect()->route('admin.systemUsers')->with('success', $success_msg);

    // }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);

        $user = ModelsUser::find($id);
        $user->password = Hash::make($request->password);
        $user->save();

        // Return a success message
        $success_msg = $user->first_name . ' ' . $user->last_name . ' password has been reset successfully.';

        return redirect()->route('admin.systemUsers')->with('success', $success_msg);
    }


    public function show($id)
    {
        $user = ModelsUser::findOrFail($id);

        return response()->json($user);
    }



    public function remove($id)
    {
        $user = ModelsUser::findOrFail($id);

        $user->delete();

        $success_msg = 'Account belonging to : '. $user->first_name . ' ' . $user->last_name . ' has been deleted successfully.';

        return redirect()->route('admin.systemUsers')->with('success', $success_msg);

    }


    public function lockSystem()
    {
        $system_users = ModelsUser::where('role_id', '!=', 1)->where('role_id', '!=', 2)->get();

        // Set all other users' account status to "locked"
        foreach ($system_users as $user) {
            $user->status = 'locked';
            $user->save();
        }

        $admin_id = Auth::user()->id; // Get the administrator's user ID

        // Invalidate sessions of other users except the administrator
        foreach ($system_users as $user) {
            if ($user->id !== $admin_id) {
                Session::forget('user_id');
                // Auth::logoutOtherDevices($user); // Invalidate sessions of locked users on other devices
            }
        }

        // Auth::logout(); // Destroy the session of the currently logged in administrator
        Session::forget('user_id'); // Remove the session data for the locked administrator

        $success_msg = 'System Access Lock has been activated successfully.';
        return redirect()->route('admin.systemUsers')->with('success', $success_msg);
    }




    public function unlockSystem()
    {
        $system_users = ModelsUser::where('role_id', '!=', 1)->where('role_id', '!=', 2)->get();

        foreach ($system_users as $user) {
            $user->status = 'activated';
            $user->save();
        }

        $success_msg = 'System Access has been restored successfully.';

        return redirect()->route('admin.systemUsers')->with('success', $success_msg);
    }
}
