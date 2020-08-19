<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    public $table='products';
    public $primaryKey='p_id';
    public $incrementing=true;
    public $keyType='int';
    
}
