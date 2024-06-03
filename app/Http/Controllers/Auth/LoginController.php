<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    protected function redirectTo()
    {
        $roleName = Auth::user()->role->name;
        Log::info('User role: ' . $roleName); // Para depuración

        if ($roleName === 'admin') {
            Log::info('Redirecting to /admin'); // Para depuración
            return '/admin';
        }

        Log::info('Redirecting to /');
        return '/';
    }

    /**
     * Handle the user after the authentication
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $roleName = $user->role->name;
        Log::info('Authenticated user role: ' . $roleName); // Para depuración

        if ($roleName === 'admin') {
            Log::info('Authenticated: Redirecting to /admin'); // Para depuración
            return redirect('/admin');
        }

        Log::info('Authenticated: Redirecting to /'); // Para depuración
        return redirect('/');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
