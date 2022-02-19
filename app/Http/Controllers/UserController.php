<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Auth;
use DB;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function ubahAkunTampil()
    {
        $user = Auth::user();
        $data = [
            'user' => $user,
        ];
        return view('admin.ubah-akun', $data);
    }

    public function ubahAkun(Request $req)
    {
        $user = Auth::user();
        $validated = $req->validate([
            'name' => ["required", "min:2", "max:200"],
            'email' => ["required", "email", "min:2", "max:100", "unique:App\Models\User,email,$user->id,NULL"],
            'username' => ["required", "min:2", "max:100", "unique:App\Models\User,username,$user->id,NULL"],
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
            'name.min' => 'Nama minimal 2 karakter.',
            'name.max' => 'Nama maksimal 200 karakter.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.min' => 'Email minimal 2 karakter.',
            'email.max' => 'Email maksimal 100 karakter.',
            'email.unique' => 'Email sudah digunakan.',
            'username.required' => 'Username tidak boleh kosong.',
            'username.min' => 'Username minimal 2 karakter.',
            'username.max' => 'Username maksimal 100 karakter.',
            'username.unique' => 'Username sudah digunakan.',
        ]);

        DB::beginTransaction();
        try {
            $user->update($validated);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Akun berhasil diubah',
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function gantiPasswordTampil()
    {
        return view('admin.ganti-password');
    }

    public function gantiPassword(Request $req)
    {
        $passlama = $req->oldpass;
        $passbaru = $req->newpass;
        $user = Auth::user();
        if (Hash::check($passlama, $user->password)) {
            $user->password = Hash::make($passbaru);
            $user->save();
            return redirect()->route('admin.akun.gantipass')->with('msg', "Password berhasil diganti, Silahkan gunakan password baru untuk login selanjutnya");
        } else {
            return redirect()->route('admin.akun.gantipass')->with('msg', 'Password lama salah');
        }
    }
}
