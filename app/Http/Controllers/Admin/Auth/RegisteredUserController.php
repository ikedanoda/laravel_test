<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admin_users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin_user = AdminUser::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($admin_user));

        Auth::guard('admin_user')->login($admin_user);

        return redirect(RouteServiceProvider::ADMIN_HOME);
    }
}
