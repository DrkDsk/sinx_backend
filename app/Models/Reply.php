<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    protected $table = 'replies';

    protected $fillable = ['post_id', 'user_id', 'anon_handle', 'text'];
}
