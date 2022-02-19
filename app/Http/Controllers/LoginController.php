<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginTampil()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('login');
    }

    public function login(Request $req)
    {
        try {
            $username = $req->username;
            $password = $req->password;
            $admin = User::where('username', $username)->first();
            if (!isset($admin) || !Hash::check($password, $admin->password)) {
                throw new Exception("Username atau Password Salah");
            }
            Auth::login($admin);

            return redirect()->route('admin.dashboard');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors([
                    'mess' => $e->getMessage()
                ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
