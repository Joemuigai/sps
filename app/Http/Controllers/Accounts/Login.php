<?php

namespace App\Http\Controllers\Accounts;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;


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
