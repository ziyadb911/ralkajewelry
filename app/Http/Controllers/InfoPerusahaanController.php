<?php

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use DB;
use Exception;
use File;
use Illuminate\Http\Request;
use Image;

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
            'invitation_text' => ["nullable"],
            'wa' => ["nullable", "max:20"],
            'facebook' => ["nullable", "max:100"],
            'instagram' => ["nullable", "max:100"],
            'twitter' => ["nullable", "max:100"],
            'tiktok' => ["nullable", "max:100"],
            'tokopedia' => ["nullable", "max:100"],
            'logo' => ["nullable"],
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
            'twitter.max' => 'TikTok maksimal 100 karakter.',
            'twitter.max' => 'Tokopedia maksimal 100 karakter.',
        ]);

        DB::beginTransaction();
        try {
            $company->update($validated);
            if (isset($request->login_background)) {
                if (File::exists($company->login_background) && $company->login_background != 'img/bg-login.jpg') {
                    File::delete($company->login_background);
                }
                $path = 'img/company';
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }
                $namafoto = "bg-login-" . now()->format('Hisu') . '.jpg';
                $img = Image::make($request->login_background);
                $width = $img->width();
                $height = $img->height();
                $img = $img->encode('jpg', 100);
                if ($width > $height) {
                    if ($width > 2000) {
                        $img->resize(2000, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                } else {
                    if ($height > 2000) {
                        $img->resize(null, 2000, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                }

                $lokasisimpan = $path . "/" . $namafoto;
                $img->save($lokasisimpan);

                $company->login_background = $lokasisimpan;
                $company->save();
            }
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
