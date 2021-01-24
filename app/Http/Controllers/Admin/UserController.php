<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CompanyOfficer;
use App\Models\Company;
class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth:adminMiddle');
    }
    public function index()
    {
		//$users=User::whereType('Member')->whereActive('1')->paginate(5);
		$users=User::SAdmMemberList()->select('users.name','users.email','a.username',
			'a.photo','c.name as city','d.name as province','e.name as country',
			'users.active','users.verified','users.created_at'
		)->where('users.type','=','Member')
		->groupBy('users.name','users.email','a.username',
			'a.photo','c.name','d.name','e.name',
			'users.active','users.verified','users.created_at'
		)		
		->paginate(5);		
		return view('admin.user.index')->with(compact('users'));
    }
		
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
