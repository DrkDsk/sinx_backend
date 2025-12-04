<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserReason extends Model
{
    protected $fillable = ['user_id', 'order_index', 'reason'];
}
