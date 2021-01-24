<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactReply extends Model
{
    protected $table = 'contact_replies';	
	protected $primaryKey = 'id';	
	public $timestamps = true;
    protected $fillable = [
		'contact_id',
        'user_id',
		'parent_id',
		'message',	
    ];
    public function user()
    {
		return $this->belongsTo(User::class);
    }
    public function contact()
    {
		return $this->belongsTo(Contact::class);
    }	
}
