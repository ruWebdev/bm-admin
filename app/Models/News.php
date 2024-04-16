<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasUuids, HasFactory;

    protected $table = 'news';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'page_alias',
        'title',
        'main_photo',
        'short_description',
        'long_description',
        'moderation_status',
        'allowed',
        'enable',
        'status',
        'archive',
        'views_count',
    ];
}
