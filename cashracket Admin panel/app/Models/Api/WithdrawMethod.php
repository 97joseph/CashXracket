<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class WithdrawMethod extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getImageAttribute():string
    {
        return  URL::to('/').'/'.$this->attributes['image'];
    }
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'minimum_amount' => 'integer',
        'status' => 'integer',
    ];
}
