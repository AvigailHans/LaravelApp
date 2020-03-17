<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    protected $table='mydata';
    public $pk ='id';
    public $street= 'street';
    public $city ='city';
}
