<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liste extends Model
{
    protected $fillable = [
        'base_id', 'filename', 'extension', 'filesize'
    ];
    
}
