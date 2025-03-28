<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'product_id',
        'name'
    ];

    public $timestamps = false;
}
