<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /**
     * Handle the authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Retrieve the authenticated user
            $user = Auth::user();
            
            // Check if the user is an admin
            if ($user->admin) {
                // If successful and user is an admin, return the view directly
                return view('webpages.adminfolder.page'); // Change to the actual view path
            } else {
                // Log the user out if they are not an admin
                Auth::logout();

                // Redirect back with an error
                return Redirect::back()->withErrors([
                    'email' => 'You do not have admin privileges.',
                ])->withInput($request->only('email'));
            }
        }

        // If unsuccessful, redirect back with an error
        return Redirect::back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }
}
