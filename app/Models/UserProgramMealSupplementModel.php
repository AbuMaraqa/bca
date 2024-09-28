<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProgramMealSupplementModel extends Model
{
    use HasFactory;

    protected $table = 'user_program_meal_supplement';

    public function supplement(){
        return $this->belongsTo(SupplementsModel::class , 'supplement_id' , 'id');
    }
}
