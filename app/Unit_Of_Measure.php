<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit_Of_Measure extends Model
{
  protected $table = 'unit_of_measures';
  protected $fillable = ['name', 'slug', 'description'];
}
