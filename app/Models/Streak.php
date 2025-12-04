<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Streak extends Model
{
    protected $fillable = [
        'user_id',
        'current_count',
        'last_increment_date',
        'last_relapse_date',
        'start_date'
    ];
}
