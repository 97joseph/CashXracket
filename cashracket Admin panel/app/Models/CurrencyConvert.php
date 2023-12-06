<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyConvert extends Model
{
    use HasFactory;
    protected $fillable = ['currency_id','par_currency','coin','status'] ;

    function currency(){
        return $this->belongsTo(Currency::class);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'coin' => 'string',
        'status' => 'integer',
        'currency_id' => 'integer',
        'par_currency' => 'integer',
    ];
}
