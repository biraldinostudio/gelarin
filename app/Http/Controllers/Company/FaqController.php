<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
class FaqController extends Controller
{
    public function index(Request $request)
    {
		$keyword=$request->keyword; 
		$faqs=Faq::whereActive('1')->where('translation_lang','=',app()->getLocale())->whereType('Company')
		->where(function($q) use($keyword)
            {
                $q->where('title','ILIKE', '%'.trim($keyword).'%')
                ->orWhere('content','ILIKE', '%'.trim($keyword).'%');
            })
		->paginate(10);
		return view('company.faq.index')->with(compact('faqs'));
		
    }
}
