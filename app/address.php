<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    protected $table='address';
    public $street= 'street';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'street',
        'city',
        'lat',
        'lng'
  ];
}
