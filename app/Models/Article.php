<?php

namespace App\Models;

use App\Helpers\DateHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;
    // protected $appends = ['created_at_formatted','updated_at_formatted'];
    protected $fillable = [
        'article_category_id',
        'slug',
        'title',
        'content',
        'image_url',
        'is_shown',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function articleCategory()
    {
        return $this->belongsTo(ArticleCategory::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, ArticleTag::class);
    }

    public function userCreate()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function userUpdate()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function getCreatedAtDateAttribute()
    {
        return isset($this->created_at) ? DateHelper::dateToString($this->created_at) : null;
    }

    public function getCreatedAtFormattedAttribute()
    {
        return isset($this->created_at) ? DateHelper::dateTimeToString($this->created_at) : null;
    }

    public function getUpdatedAtFormattedAttribute()
    {
        return isset($this->updated_at) ? DateHelper::dateTimeToString($this->updated_at) : null;
    }
}
