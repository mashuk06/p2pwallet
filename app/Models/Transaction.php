<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * @var array
     *
     * The attributes that are mass assignable
     */
    protected $fillable = [
        'receiver_id',
        'transaction_type',
        'actual_amount',
        'converted_amount',
        'conversion_rate',
        'transaction_description'
    ];
}
