<?php

namespace App\Http\Controllers;
use App\Models\ArticleComment;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
Use Carbon\Carbon;
use DateTime;
class ArticleCommentController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
    }
    public function store(Request $request,$id)
    {
        Validator::make($request->all(), [
           	'value'=> 'required',
           	'comment'=> 'required|string|min:10|max:522',			
        ])->validate();		
		$postComment = ArticleComment::create([
				'parent'=>'0',
                'article_id' => $id, 
				'user_id' => Auth::User()->id, 
				'comment' => $request->comment,
				'value'=>$request->value,
				'active'=>'1',						
		]);			
        if(!empty($postComment)) {
			return redirect()->back()->with(['message' => trans('global.The article was posted successfully, waiting for a review by the editor')]);
        } else {
			return redirect()->back()->with(['message' => trans('global.Article failed to post')]);
        }
		
    }
	
    public function reply(Request $request)
    {
        Validator::make($request->all(), [
           	'value'=> 'required',
           	'comment'=> 'required|string|min:10|max:522',			
        ])->validate();
		$postComment = ArticleComment::create([
				'parent_id'=>$request->idx,
                'article_id' => $request->article_id, 
				'user_id' => Auth::User()->id, 
				'comment' => $request->comment,
				'value'=>$request->value,
				'active'=>'1',						
		]);
        if(!empty($postComment)) {
			return redirect()->back()->with(['message' => trans('global.The article was posted successfully, waiting for a review by the editor')]);
        } else {
			return redirect()->back()->with(['message' => trans('global.Article failed to post')]);
        }
		
    }	
}
