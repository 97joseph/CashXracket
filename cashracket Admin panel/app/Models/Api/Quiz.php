<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Quiz extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getImageAttribute(): string
    {

        return URL::to('/'). '/' . $this->attributes['image'];
    }

    public function questions()
    {
        return $this->hasMany(Question::class,'quiz_id');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'category_id' => 'integer',
        'paid_status' => 'integer',
        'free_or_paid' => 'integer',
        'reward_point' => 'integer',
        'retake_point' => 'integer',
        'status' => 'integer',
    ];
}
