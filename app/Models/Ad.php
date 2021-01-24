<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = 'ads';
    protected $fillable = [
		'id',
		'user_id',
		'date',
		'hours',		
		'number',
		'title',
		'banner',
		'link',
		'section',
		'position',
		'type',
		'end_date',
		'currency_code',
		'rates',
		'payment_status',
		'active',		
		'activation_token',
		'created_at',
		'updated_at',             
    ];
}
