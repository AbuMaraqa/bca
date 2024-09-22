<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramMealModel extends Model
{
    use HasFactory;

    protected $table = 'program_meal';

    public function meal_type(){
        return $this->belongsTo(MealTypeModel::class , 'meal_type_id' , 'id');
    }
}
