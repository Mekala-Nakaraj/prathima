<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
    public function login(Request $request)
    {
        // Validate the form data
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

     
        // Check if the user provided an email or phone number
        $username = $request->input('username');
        $field = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';

        // Prepare credentials
        $credentials = [
            $field => $username,
            'password' => $request->input('password'),
           
        ];
        // if (Auth::attempt($credentials)) {

        //     $request->session()->regenerate();

        //     return view('auth.hello');
        // }
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            if ($user->user_type == 'admin') {
                // dd('admin');
                return redirect('/dashboard');
            }
            if ($user->user_type == 'user') {
                // dd('user');
                return redirect('/dashboard');
            }
    
            return view('auth.hello');
        }
        // dd($credentials);

        // Attempt to authenticate the user
      

        // Authentication failed, redirect back with error message
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function adminDashboard()
    {
        return view('backend.dashboard');
    }

    public function Dashboard()
    {
        return view('backend.dashboard');
    }


}
