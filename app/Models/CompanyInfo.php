<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone1',
        'phone2',
        'email',
        'url',
        'address',
        'invitation_text',
        'invitation_image_url',
        'wa',
        'facebook',
        'instagram',
        'twitter',
        'tiktok',
        'tokopedia',
        'logo',
        'login_background',
    ];
}
