<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyRewards extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','description','amount','gain_status','status'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'amount' => 'integer',
        'status' => 'integer',
    ];
}
