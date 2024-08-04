<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentsModel extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    public function client()
    {
        return $this->belongsTo(ClientsModel::class, 'customer_id' , 'id');
    }
}
