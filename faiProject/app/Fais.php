<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fais extends Model
{
    protected $fillable = [
      'name'
    ];
    public static function lastFaisId(){
        return static::query()->max('id');
    }
}
