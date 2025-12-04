<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StreakAdjustment extends Model
{
    protected $fillable = ['streak_id', 'date', 'delta', 'note'];
}
