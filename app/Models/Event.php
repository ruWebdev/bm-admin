<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasUuids, HasFactory;

    protected $table = 'events';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'artist_id',
        'performer_id',
        'event_date',
        'event_time',
        'title',
        'place',
        'additional_artists',
        'contents',
        'age_restrictons',
        'ticket_price_from',
        'ticket_price_to',
        'external_link',
        'can_preorder',
        'sold_out',
        'is_active',
        'is_archive',
        'main_image',
        'images',
        'video',
        'tags',
        'views_count',
        'moderation_status',
        'status',
    ];
}
