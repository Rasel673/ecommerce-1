<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubcategoryModel extends Model
{
    public $table='subcategories';
    public $primaryKey='sub_id';
    public $incrementing=true;
    public $keyType='int';
    public $timestamps=false;
}
