<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trophy extends Model
{
    protected $table = 'trophies';

    protected $fillable = [
        'user_id',
        'day_required',
        'description',
        'earned_at',
        'is_earned',
        'tier',
        'title',
        'trophy_number'
    ];
}
