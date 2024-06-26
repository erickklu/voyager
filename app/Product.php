<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;



class Product extends Model
{
    use Translatable;

    protected $translatable = ['name', 'body'];

    protected $fillable = ['name', 'body'];
    
}
