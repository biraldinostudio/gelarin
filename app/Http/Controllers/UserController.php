<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hashids\Hashids;
use App\Models\User;
use App\Models\UserDesription;
class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');			
    }	

    public function show($id,$name, Request $request){
		$crypto = new Hashids();
		$users=User::whereId($crypto->decodeHex($id))->with('userdescription')
//->join('userdescription', 'deliveries.order_id', '=', 'orders.id')
//->where('orders.user_id', $customerID)		
		->first();	
		return view('user.detail', compact('users','crypto'));
    }
	
    public function authorShow($id,$name, Request $request){
		$crypto = new Hashids();
		$users=User::whereId($crypto->decodeHex($id))->with('userdescription')		
		->first();	
		return view('author.detail', compact('users','crypto'));
    }	

}
