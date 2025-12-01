<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = ['content_html', 'order_index', 'read_time', 'summary', 'title'];
}
