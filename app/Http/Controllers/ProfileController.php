<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    //
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // Validate 
        $validatedData = $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|string|email" 
        ]);

        $user->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'Profile info updated');

    }
}