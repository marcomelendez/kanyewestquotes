<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function profile()
    {
        $userId = Auth()->user()->id;
        $user = User::find($userId);

        return Inertia::render('Profile', compact('user'));
    }

    public function updateProfile(request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $user = User::find($id);
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;

        $user->save();

        return redirect()->route('profile')->with('message','Quotes delete successfully');
    }
}
