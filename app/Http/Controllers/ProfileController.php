<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // Validate 
        $validatedData = $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|string|email" ,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Get user name and email 
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Handle avatart upload
        if ($request->hasFile('avatar')) {

            // Delete old avatar
            if ($user->avatar) {
                Storage::delete('public/' . $user->avatar);
            }

            # Store new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return redirect()->route('dashboard')->with('success', 'Profile info updated');

    }
}