<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{

     public function create()   
    {
        return view('auth.register'); // pastikan ada file blade ini
    }


    public function store(Request $request): RedirectResponse
    {
        $request->validate([    
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:mentor,mentee'], // validasi role
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // simpan role
        ]);

        event(new Registered($user));

        Auth::login($user);

        if ($user->role === 'mentor') {
    return redirect()->route('mentor.dashboard'); // pastikan ini ada
} else {
    return redirect()->route('mentee.dashboard'); // pastikan ini juga
} // redirect setelah register
    }
}
