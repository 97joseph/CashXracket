<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuiz extends Model
{
    use HasFactory;
    protected $fillable =['user_id','question_id','quiz_id','amount','win_status','result_status','status'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'quiz_id' => 'integer',
        'amount' => 'integer',
        'status' => 'integer',
    ];
}
