<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected  $fillable = ['user_id','content', 'is_from_user', 'timestamp'];
}
