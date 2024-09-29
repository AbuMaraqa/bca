<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersProgramModel extends Model
{
    use HasFactory;

    protected $table = 'users_program';

    public function client(){
        return $this->belongsTo(ClientsModel::class,'client_id','id');
    }
}
