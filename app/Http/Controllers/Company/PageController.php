<?php

namespace App\Http\Controllers\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use View;
class PageController extends Controller
{
    public function __construct(){
        $this->middleware('auth:companypage');
    }	    
	
	public function show($slug)	
    {
        $pages = Page::whereSlug($slug)->where('translation_lang',app()->getLocale())->where('active','1')->first();
		if(!empty($pages->slug)){
			return View::make('company.page.index')->with('pages', $pages);
		}
		else{
			return \Response::view('company.errors.404',array(),404);
		}
    }
}
