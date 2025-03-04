<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'coins',
        'notes',
        'status',
        'amount',
        'user_id',
        'account',
        'method_id',
        'method_id',
        'approve_status',
        'currency_convert_id',
    ];

    protected static $requests;

    public static function addRequest($request)
    {
        self::$requests = new WithdrawRequest();
        self::$requests->method_id         = $request->method_id;
        self::$requests->name              = $request->name;
        self::$requests->points            = $request->points;
        self::$requests->account           = $request->account;
        self::$requests->amount            = $request->amount;
        self::$requests->status            = $request->status;
        self::$requests->save();
    }
    public static function updateRequest ($request, $id)
    {
        self::$requests = WithdrawRequest::find($id);
        self::$requests->method_id         = $request->method_id;
        self::$requests->name              = $request->name;
        self::$requests->points            = $request->points;
        self::$requests->account           = $request->account;
        self::$requests->amount            = $request->amount;
        self::$requests->status            = $request->status;
        self::$requests->save();
    }
    public function methodName()
    {
       return $this->belongsTo(WithdrawMethod::class, 'method_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function convert()
    {
        return $this->belongsTo(CurrencyConvert::class, 'currency_convert_id');
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
