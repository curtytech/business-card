<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        // Slug apenas com letras, números e hifens (espaços -> "-")
        $base = Str::slug($validated['name']);
        $base = preg_replace('/[^a-z0-9-]/', '', $base) ?: 'user';

        // Garante unicidade
        $slug = $base;
        $i = 1;
        while (User::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->slug = $slug;
        $user->password = Hash::make($validated['password']);
        $user->save();

        Auth::login($user);

        return redirect('/'); // ou: return redirect()->route('users.show', ['user' => $user->slug]);
    }
}