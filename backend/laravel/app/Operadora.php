<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Swagger\Annotations as SWG;


class Operadora extends Model
{

    protected $table = 'operadoras';

    protected $fillable = ['id', 'nome', 'codigo'];

}
