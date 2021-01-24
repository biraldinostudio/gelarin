<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Untuk hapus data sementara dan permanen
class UserSkill extends Model
{
	use SoftDeletes;//Untuk hapus data sementara dan permanen	
    protected $table = 'user_skills';
    //public $timestamps = false;
	protected $primaryKey = 'id';
	protected $dates = ['deleted_at'];//Untuk hapus data sementara dan permanen		
    protected $fillable = [
 		'user_id',
 		'skill',
 		'value',
    ]; 
	public function user(){
        return $this->belongsTo(User::class);		
	}	
}
