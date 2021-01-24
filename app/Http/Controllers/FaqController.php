<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
class FaqController extends Controller
{

    public function index(Request $request)
    {
		$keyword=$request->keyword; 
		$faqs=Faq::whereActive('1')->where('translation_lang','=',app()->getLocale())->whereType('Member')
		->where(function($q) use($keyword)
            {
                $q->where('title','ILIKE', '%'.trim($keyword).'%')
                ->orWhere('content','ILIKE', '%'.trim($keyword).'%');
            })
		->paginate(10);
		return view('faq.index')->with(compact('faqs'));
		
    }
}
