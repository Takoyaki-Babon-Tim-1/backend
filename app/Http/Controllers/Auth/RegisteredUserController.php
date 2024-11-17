<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Laravolt\Avatar\Facade as Avatar;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    
        $avatarPath = 'avatars/' . uniqid() . '.png';
        Avatar::create($request->name)->save(storage_path('app/public/' . $avatarPath));
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'avatar' => $avatarPath, 
            'password' => Hash::make($request->password),
        ]);
    
        $userRole = Role::where('name', 'buyer')->first();
        if ($userRole) {
            $user->assignRole($userRole);
        }
        event(new Registered($user));
    
        Auth::login($user);
    
        return redirect()->route('verification.notice');
    }
}
