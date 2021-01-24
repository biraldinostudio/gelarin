<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use View;
class PageController extends Controller
{
    public function show($slug)	
    {
        $pages = Page::whereSlug($slug)->where('translation_lang',app()->getLocale())->where('active','1')->first();
		if(!empty($pages->slug)){
			return View::make('page.index')->with('pages', $pages);
		}
		else{
			return \Response::view('errors.404',array(),404);
		}
    }
}
