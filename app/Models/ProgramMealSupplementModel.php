<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramMealSupplementModel extends Model
{
    use HasFactory;

    protected $table = 'program_meal_supplement';

    public function supplement(){
        return $this->belongsTo(SupplementsModel::class , 'supplement_id' , 'id');
    }
}
