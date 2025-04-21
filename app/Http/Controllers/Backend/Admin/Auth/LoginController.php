<?php

namespace App\Http\Controllers\Backend\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function redirectTo()
    {
        return route("admin.dashboard");
    }


    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        return view('backend.admin.auth.login'); // Return the login form view
    }

    /**
     * Guard for admin authentication.
     */
    protected function guard()
    {
        return auth()->guard('admin');
    }

    /**
     * Log the admin out and redirect to login page.
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
