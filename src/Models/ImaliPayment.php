<?php

namespace Miguelmacamo\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImaliPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_account_number', 'customer_account_number', 'amount', 'description', 'status',
        'payment_transaction', 'partner_transaction_id', 'terminalID', 'terminalChannel', 'terminalCompanyName'
    ];
}
