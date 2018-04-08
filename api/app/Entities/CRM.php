<?php

namespace api\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CRM extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "";
    
    protected $fillable = [];

}
