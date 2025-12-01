<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    protected $table = 'journal_entries';

    protected $fillable = [
        'user_id',
        'color_type',
        'image_url',
        'is_pinned',
        'mood_emoji',
        'position_x',
        'position_y',
        'rotation',
        'tags'
    ];
}
