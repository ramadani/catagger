<?php

namespace Redustudio\Catagger;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    protected $table = 'cataggers';

    protected $fillable = ['name', 'slug'];
}
