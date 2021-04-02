<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $connection = 'mysql2';

    protected $fillable = ['title', 'body'];
}
