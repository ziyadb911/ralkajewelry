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
            'wa' => ["nullable", "max:200"],
            'facebook' => ["nullable", "max:200"],
            'instagram' => ["nullable", "max:200"],
            'twitter' => ["nullable", "max:200"],
            'tiktok' => ["nullable", "max:200"],
            'tokopedia' => ["nullable", "max:200"],
            'logo' => ["nullable"],
        ], [
            'name.required' => 'Nama Perusahaan tidak boleh kosong.',
            'name.min' => 'Nama Perusahaan minimal 2 karakter.',
            'name.max' => 'Nama Perusahaan maksimal 100 karakter.',
            'phone1.max' => 'No. Telpon 1 maksimal 20 karakter.',
            'phone2.max' => 'No. Telpon 2 maksimal 20 karakter.',
            'email.max' => 'Email maksimal 100 karakter.',
            'url.max' => 'Website URL maksimal 100 karakter.',
            'wa.max' => 'WhatsApp maksimal 200 karakter.',
            'facebook.max' => 'Facebook maksimal 200 karakter.',
            'instagram.max' => 'Instagram maksimal 200 karakter.',
            'twitter.max' => 'Twitter maksimal 200 karakter.',
            'twitter.max' => 'TikTok maksimal 200 karakter.',
            'twitter.max' => 'Tokopedia maksimal 200 karakter.',
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
            
            if (isset($request->invitation_image_url)) {
                if (File::exists($company->invitation_image_url)) {
                    File::delete($company->invitation_image_url);
                }
                $path2 = 'img/promo';
                if (!File::isDirectory($path2)) {
                    File::makeDirectory($path2, 0777, true, true);
                }
                $namafoto = "ralka-jewelry-promo-" . now()->format('Hisu') . '.jpg';
                $img2 = Image::make($request->invitation_image_url);
                $width2 = $img2->width();
                $height2 = $img2->height();
                $img2 = $img2->encode('jpg', 100);
                if ($width2 > $height2) {
                    if ($width2 > 2000) {
                        $img2->resize(2000, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                } else {
                    if ($height2 > 2000) {
                        $img2->resize(null, 2000, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                }

                $lokasisimpan2 = $path2 . "/" . $namafoto;
                $img2->save($lokasisimpan2);

                $company->invitation_image_url = $lokasisimpan2;
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
