<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $userId = auth()->user()->id;
        $profile = Profile::where('user_id', $userId)->first();
        // if ($profile) {
        //     return view('pages.profile', compact('profile'));
        // } else {
            $user = auth()->user();
            return view('pages.profile', compact('profile', 'user'));
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $userId = $user->id;
        $profile = Profile::where('user_id', $userId)->first(); // Use first() instead of get()

        if ($profile) {
            $profile->update([
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
                'gender' => $request->input('gender'),
                'dob' => $request->input('dob'),
            ]);
        } else {
            $user->profile()->create([
                'user_id' => $userId,
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
                'gender' => $request->input('gender'),
                'dob' => $request->input('dob'),
            ]);
        }

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
