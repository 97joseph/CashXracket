<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    protected $fillable =['user_id','balance','status'];

    public static function addBalancePoint($user_id,$amount)
    {
        $wallet = Wallet::where('user_id',$user_id);
        if ($wallet->exists()) {
            $data['balance'] = $wallet->value('balance') + $amount;
            $wallet->update($data);
        }else {
            $wallet->create(['user_id'=>$user_id,'balance'=>$amount]);
        }
    }

    public static function removeBalancePoint($user_id,$amount)
    {
        $wallet = Wallet::where('user_id',$user_id);
        $data['balance'] = $wallet->value('balance') - $amount;
        $wallet->update($data);
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
        'balance' => 'double',
        'status' => 'integer',
    ];
}
