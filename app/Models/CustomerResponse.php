<?php

namespace App\Models;

use DateHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerResponse extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'message',
        'is_readed',
    ];

    public function getCreatedAtFormattedAttribute()
    {
        return isset($this->created_at) ? DateHelper::dateTimeToString($this->created_at) : null;
    }
}
