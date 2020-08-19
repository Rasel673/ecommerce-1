<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class CategoryModel extends Model
{
    use Searchable;
    public $table='categories';
    public $primaryKey='cat_id';
    public $incrementing=true;
    public $keyType='int';
    public $timestamps=false;
}
