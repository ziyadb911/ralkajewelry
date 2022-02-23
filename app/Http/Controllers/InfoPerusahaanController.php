<?php

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use DB;
use Exception;
use Illuminate\Http\Request;

class InfoPerusahaanController extends Controller
{
    public function infoPerusahaanTampil()
    {
        $company = CompanyInfo::findOrFail(1);
        $data = [
            'company' => $company,
        ];
        return view('admin.info-perusahaan', $data);
    }

    public function ubahInfoPerusahaan(Request $request)
    {
        $company = CompanyInfo::findOrFail(1);
        $validated = $request->validate([
            'name' => ["required", "min:2", "max:100"],
            'phone1' => ["nullable", "max:20"],
            'phone2' => ["nullable", "max:20"],
            'email' => ["nullable", "email", "max:100"],
            'url' => ["nullable", "max:100"],
            'address' => ["nullable"],
            'wa' => ["nullable", "max:20"],
            'facebook' => ["nullable", "max:100"],
            'instagram' => ["nullable", "max:100"],
            'twitter' => ["nullable", "max:100"],
            'logo' => ["nullable"],
            'login_background' => ["nullable"],
        ], [
            'name.required' => 'Nama Perusahaan tidak boleh kosong.',
            'name.min' => 'Nama Perusahaan minimal 2 karakter.',
            'name.max' => 'Nama Perusahaan maksimal 100 karakter.',
            'phone1.max' => 'No. Telpon 1 maksimal 20 karakter.',
            'phone2.max' => 'No. Telpon 2 maksimal 20 karakter.',
            'email.max' => 'Email maksimal 100 karakter.',
            'url.max' => 'Website URL maksimal 100 karakter.',
            'wa.max' => 'WhatsApp maksimal 20 karakter.',
            'facebook.max' => 'Facebook maksimal 100 karakter.',
            'instagram.max' => 'Instagram maksimal 100 karakter.',
            'twitter.max' => 'Twitter maksimal 100 karakter.',
        ]);

        DB::beginTransaction();
        try {
            $company->update($validated);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Informasi Perusahaan berhasil diubah',
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
