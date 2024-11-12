<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDebtModel extends Model
{
    use HasFactory;

    protected $table = 'customer_debts';

    protected $fillable = [
        'client_id',
'value',
'type',
'insert_at',
'discount',
'total_amount',
'notes'
    ];
}
