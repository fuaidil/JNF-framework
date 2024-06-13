<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function prosesLogin(Request $request)
    {
        if (Auth::attempt($request->only(['email','password'])))
        {
            session(['user'=>Auth::user()]);
            return redirect(route('dashboard'));

        } else {
            return redirect(route('login'))->with('error', 'Email or Password is incorrect.');
        }
    }

    public function prosesRegister(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->isAdmin = 0;
        $user->save();

        return redirect(route('login'))->with('success', 'Registration successful! You can now log in.');
    }

    public function dashboard()
    {
        $user = User::all();
        return view('admin.dashboard', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        if ($request->password)
        {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
        }
    }

    public function newAccount()
    {
        return view('admin.add');
    }

    public function addAccount(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->isAdmin = 1;
        $user->save();

        return redirect(route('user'));
    }

    public function editAccount(User $user)
    {
        // $user = User::find($user);
        return view('admin.edit', compact('user'));
    }

    public function updateAccount(Request $request, User $user)
    {
        // $user = User::find($user->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();
        return redirect()->route('user');
    }

    public function deleteAccount(User $user)
    {
        $user->delete();
        return redirect()->route('user');
    }

    // public function delete($user)
    // {
    //     $user = User::find($user);
    //     $user->delete();
    //     return redirect()->route('user');
    // }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
