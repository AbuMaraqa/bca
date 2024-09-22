<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramModel extends Model
{
    use HasFactory;

    protected $table = 'program';

    public function program_category(){
        return $this->belongsTo(ProgramCategoryModel::class , 'program_category_id' , 'id');
    }
}
