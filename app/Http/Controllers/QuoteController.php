<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class QuoteController extends Controller
{
    public function index()
    {
        return Inertia::render('Quotes');
    }

    public function geretateToken(request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }


        return response()->json([
            'token' => $user->createToken($request->device_name)->plainTextToken,
        ]);
    }

    public function favorites()
    {
        $userId = Auth()->user()->id;

        $favorites = Favorite::where('user_id',$userId)->get();
        return Inertia::render('Favorites',compact('favorites'));
    }

    public function destroy($id)
    {
        $favorite = Favorite::find($id);
        $favorite->delete();

        return redirect()->route('favorites')->with('message','Quotes delete successfully');
    }
}
