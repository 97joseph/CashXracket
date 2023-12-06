<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGain extends Model
{
    use HasFactory;

    protected  $fillable = ['user_id', 'description', 'amount', 'gain_status', 'status'];

    public static function addGainLoss($data=null)
    {
        if ($data != null) {
            UserGain::create($data);
        } else {
            return back();
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
