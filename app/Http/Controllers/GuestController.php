<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GuestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => uniqid() . '@guest.local', // tijdelijke fake email
            'password' => bcrypt('guest1234'),    // dummy wachtwoord
            'role' => 'user'
        ]);

        // Zet user ID in de sessie
        session(['user_id' => $user->id]);

        return redirect()->route('selectquiz');
    }
}

