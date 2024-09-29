<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProgramMealModel extends Model
{
    use HasFactory;

    protected $table = 'user_program_meal';

    public function meal_type(){
        return $this->belongsTo(MealTypeModel::class , 'meal_type_id' , 'id');
    }

    public function program_meal_supplement(){
        return $this->hasMany(UserProgramMealSupplementModel::class , 'program_meal_id' , 'id' );
    }
}
