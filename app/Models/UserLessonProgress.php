<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLessonProgress extends Model
{
    protected $table = 'user_lesson_progress';

    protected $fillable = ['user_id', 'lesson_id', 'completed', 'completed_at'];
}
