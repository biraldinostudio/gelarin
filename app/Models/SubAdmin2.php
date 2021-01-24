<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubAdmin2 extends Model
{
    //
    protected $table = 'subadmin2';
    protected $primaryKey = 'code';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['code', 'name', 'asciiname', 'active'];	
}
