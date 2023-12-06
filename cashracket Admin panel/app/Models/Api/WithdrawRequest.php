<?php

namespace App\Models\Api;

use App\Models\CurrencyConvert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function withdrawMethods()
    {
        return $this->belongsTo(WithdrawMethod::class,'method_id');
    }

    public function currencyConvert()
    {
        return $this->belongsTo(CurrencyConvert::class,'currency_convert_id');
    }

    public static function witdrawRequestCountByUser($user_id)
    {
        if (WithdrawRequest::where('user_id',$user_id)->exists()) {
            return WithdrawRequest::where('user_id',$user_id)->count();
        }else {
            return 0;
        }
    }
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'method_id' => 'integer',
        'currency_convert_id' => 'integer',
        'coins' => 'integer',
        'amount' => 'double',
        'approve_status' => 'integer',
        'status' => 'integer',
    ];
}
