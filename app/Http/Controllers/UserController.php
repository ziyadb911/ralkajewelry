<?php

namespace App\Http\Controllers;

use Hash;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function gantiPasswordTampil(){
        return view('admin.gantipassword');
    }

    public function gantiPassword(Request $req){
        $passlama = $req->oldpass;
        $passbaru = $req->newpass;
        $user = Auth::user();
        if(Hash::check($passlama,$user->password)){
            $user->password = Hash::make($passbaru);
            $user->save();
            return redirect()->route('admin.akun.gantipass')->with('msg','Password berhasil diganti');
        }else{
            return redirect()->route('admin.akun.gantipass')->with('msg','Password lama salah');
        }
    }
}
