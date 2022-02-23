<?php

namespace App\Models;

use App\Helpers\DateHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleCategory extends Model
{
    use HasFactory, SoftDeletes;
    // protected $appends = ['created_at_formatted','updated_at_formatted'];
    protected $fillable = [
        'name',
    ];

    public function getCreatedAtFormattedAttribute(){
        return isset($this->created_at) ? DateHelper::dateTimeToString($this->created_at) : null;
    }

    public function getUpdatedAtFormattedAttribute(){
        return isset($this->updated_at) ? DateHelper::dateTimeToString($this->updated_at) : null;
    }
}
