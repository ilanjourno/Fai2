<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repoussoir extends Model
{
    protected $fillable = [
        'filename', 'extension', 'filesize'
    ];
}
