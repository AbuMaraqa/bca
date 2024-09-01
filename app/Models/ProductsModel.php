<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    use HasFactory;

    protected $table = 'product';

    public function category()
    {
        return $this->belongsTo(CategoryModel::class , 'category_id' , 'id');
    }
}
