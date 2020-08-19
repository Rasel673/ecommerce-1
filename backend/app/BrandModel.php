<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrandModel extends Model
{
    public $table='brands';
    public $primaryKey='b_id';
    public $incrementing=true;
    public $keyType='int';
    public $timestamps=false;
}
