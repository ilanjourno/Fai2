<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destinataire extends Model
{
    protected $fillable = [
        'email', 'list_id', 'status'
    ];
}
