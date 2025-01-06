<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', // Add your attribute here
        'description',
        'price',
        'image',
        'category_id',
        // other attributes...
    ];
    //
}