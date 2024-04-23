<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    use HasUuids, HasFactory;

    protected $table = 'bands';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'page_alias',
        'user_id',
        'title',
        'country',
        'city',
        'main_photo',
        'short_description',
        'long_description',
        'enable',
        'moderation_status',
        'allowed', 
        'status',       
    ];
}
