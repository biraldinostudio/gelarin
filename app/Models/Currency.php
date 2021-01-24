<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    //
    protected $table = 'currencies';
    public $timestamps = false;
    protected $guarded = ['id'];	
    protected $fillable = [
        'code',
        'name',
        'active',
    ];
    public $translatable = ['name'];		
}
