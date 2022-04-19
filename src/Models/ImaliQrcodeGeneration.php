<?php

namespace Miguelmacamo\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImaliQrcodeGeneration extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction', 'address_store', 'institution', 'promo', 'account_number', 'status', 'amount'
    ];
}
