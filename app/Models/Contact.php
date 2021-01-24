<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{	
    protected $table = 'contacts';	
	protected $primaryKey = 'id';	
	public $timestamps = true;
    protected $fillable = [
        'user_id',
		'message',		
    ];
    public function user()
    {
		return $this->belongsTo(User::class);
    }

    public function contactreply(){
        return $this->hasMany(ContactReply::class);
    }		
}
