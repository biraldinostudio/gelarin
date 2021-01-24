<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    protected $guarded = [];
		 protected $primaryKey = 'user_id';
		public $timestamps = true;
     protected $fillable = [
        'user_id','token',
    ];	
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
