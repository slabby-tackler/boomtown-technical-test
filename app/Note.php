<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;

    protected $casts = [
    	'id' => 'integer',
    	'title' => 'string',
    	'note' => 'string'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
