<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	protected $table = 'settings';
    protected $fillable = [
        'title',
        'description',
        'keyword',
        'welcome',		
        'mail_driver',
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_address',
        'mail_name',
        'mail_password',
        'mail_encryption'
    ];
}
