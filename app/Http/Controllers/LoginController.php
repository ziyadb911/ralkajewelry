<?php

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use App\Models\User;
use Exception;
use File;
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
        $company = CompanyInfo::findOrFail(1);
        $data = [
            'login_background' => File::exists($company->login_background) ? $company->login_background : 'img/bg-login.jpg',
        ];
        return view('login', $data);
    }

    public function login(Request $request)
    {
        try {
            $username = $request->username;
            $password = $request->password;
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
