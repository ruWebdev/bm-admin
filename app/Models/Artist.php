<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasUuids, HasFactory;

    protected $table = 'artists';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'last_name',
        'first_name',
        'middle_name',
        'birth_place',
        'birth_date',
        'short_biography',
        'biography',
        'alias',
        'show_birth_place',
        'show_birth_date',
        'enable_page',
    ];
}
