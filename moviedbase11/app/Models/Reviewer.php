<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviewer extends Model
{
    //
    // protected $table = 'reviewer';
    protected $primaryKey = 'rev_id';
    public $incrementing = false;
    public $timestamps = false;
}
