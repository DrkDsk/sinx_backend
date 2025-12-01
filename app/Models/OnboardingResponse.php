<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnboardingResponse extends Model
{
    protected $fillable = ['user_id', 'question_number', 'response'];
}
