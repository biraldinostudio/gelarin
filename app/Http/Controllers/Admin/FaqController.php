<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str; // untuk slug atau tags
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\RedirectResponse;
use Path\To\DOMDocument;
Use Carbon\Carbon;
use DateTime;
use File;
use Storage;
use App\Models\Faq;
use Route;
class FaqController extends Controller
{

    public function __construct(){
        $this->middleware('auth:adminMiddle');
    }	

    public function index()
    {
		if(Route::is('admin.faq.active')){
			$faqs=Faq::whereActive('1')->where('translation_lang', app()->getLocale())->paginate(5);
		}
		if(Route::is('admin.faq.inactive')){
			$faqs=Faq::whereActive('0')->where('translation_lang', app()->getLocale())->paginate(5);
		}
		return view('admin.faq.index')->with(compact('faqs'));		
    }


    public function create()
    {
		return view('admin.faq.create')->with(compact(''));
    }


    public function store(Request $request)
    {
		Validator::make($request->all(), [
			'type' => 'required',
           	'title'=> 'required',
           	'content'=> 'required|string|min:200|max:1000000',
            'active'=> 'required',			
        ])->validate();
        $storage="storage/uploads/faq/content/";
        $public_path="storage/uploads/faq/content/";	
		
        $content=$request->content;
		libxml_use_internal_errors(true); // untuk menonaktifkan peringatan DOM null
		$dom = new \DOMDocument();
		libxml_use_internal_errors(true);//Tambah bro	
		$dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
		libxml_clear_errors();//Tambag bro
		
		$images = $dom->getElementsByTagName('img');
		
		foreach($images as $img){
			$src = $img->getAttribute('src');
			if(preg_match('/data:image/', $src)){
				// dapatkan mimetype
				preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
				$mimetype = $groups['mime'];
				$filename = uniqid();
				$filenameRand = 'Content'.'_'.auth()->user()->id.'_'.substr(md5($filename),6,6).'_'.time();						

				//if($getFaqs->content!=$request->content){
					$filepath = ("$public_path/$filenameRand.$mimetype");
					$image=Image::make($src)
						//->resize(300, 300)
						->encode($mimetype, 100)
						->save(public_path($filepath));
					$new_src = asset($filepath);
					$img->removeAttribute('src');
					$img->setAttribute('src', $new_src);
					$img->setAttribute('class','img-responsive');
				//}
			}
		}		
		
		if($request->hasFile('cover')) {
			$storage="public/uploads/faq/";
			$public_path="storage/uploads/faq/";

			// dapatkan nama file dengan ekstensi
			$filenamewithextension = $request->file('cover')->getClientOriginalName();

			// dapatkan nama file tanpa ekstensi
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

			// dapatkan ekstensi file
			$extension = $request->file('cover')->getClientOriginalExtension();

			// nama file untuk disimpan
			$filenametostore = auth()->user()->id.'_'.substr(md5($filename),6,6).'_'.time().'.'.$extension;			

			//Unggah file
			$request->file('cover')->storeAs($storage, $filenametostore);

			// Ubah ukuran gambar di sini
			$thumbnailpath = public_path($public_path.$filenametostore);
			$img = Image::make($thumbnailpath)->resize(1698, 1698, function($constraint) {
				$constraint->aspectRatio();
			});
			$img->save($thumbnailpath);		
		}
		if($request->hasFile('cover')) {
			$cekFileName=$filenametostore;
		}
		else{			   
			$cekFileName='';
		}		
		$process = Faq::create([
			'type' =>$request->type,
			'translation_lang'=>'id',
			'translation_of'=>'0',
			'name' => ucwords(strtolower($request->title)),
			'title' => ucwords(strtolower($request->title)),
			'content'=>$dom->saveHTML(),
			'slug' => Str::slug($request->get('title')),
			'picture' => $cekFileName,
			'active' => $request->active					
		]);
		
		$process = Faq::whereId($process->id)->first();
		$process->update([        
			$process->translation_of=$process->id
		]);		
		
		if(!$process){
			return back()->with('error', trans('message.Data failed to change'));				
		}
		else{
			return back()->with('success', trans('message.Data successfully changed'));	
		}	
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
		$faqs=Faq::find($id);
		return view('admin.faq.edit')->with(compact('faqs'));
    }


    public function update(Request $request, $id)
    {
		$getFaqs=Faq::whereId($id)->first();
		Validator::make($request->all(), [
			'type' => 'required',
           	'title'=> 'required',
           	'content'=> 'required|string|min:200|max:1000000',
            'active'=> 'required',			
        ])->validate();

        $storage="storage/uploads/faq/content/";
        $public_path="storage/uploads/faq/content/";	
		
        $content=$request->content;
		libxml_use_internal_errors(true); // untuk menonaktifkan peringatan DOM null
		$dom = new \DOMDocument();
		libxml_use_internal_errors(true);//Tambah bro	
		$dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
		libxml_clear_errors();//Tambag bro
		
		$images = $dom->getElementsByTagName('img');
		
		foreach($images as $img){
			$src = $img->getAttribute('src');
			if(preg_match('/data:image/', $src)){
				// dapatkan mimetype
				preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
				$mimetype = $groups['mime'];
				$filename = uniqid();
				$filenameRand = 'Content'.'_'.$getFaqs->id.'_'.substr(md5($filename),6,6).'_'.time();						

				if($getFaqs->content!=$request->content){
					$filepath = ("$public_path/$filenameRand.$mimetype");
					$image=Image::make($src)
						//->resize(300, 300)
						->encode($mimetype, 100)
						->save(public_path($filepath));
					$new_src = asset($filepath);
					$img->removeAttribute('src');
					$img->setAttribute('src', $new_src);
					$img->setAttribute('class','img-responsive');
				}
			}
		}		
		
		if($request->hasFile('cover')) {
			$storage="public/uploads/faq/";
			$public_path="storage/uploads/faq/";

			//Hapus file lama
			if(\File::exists($public_path.$getFaqs->picture)){
				\File::delete($public_path.$getFaqs->picture);
			}

			// dapatkan nama file dengan ekstensi
			$filenamewithextension = $request->file('cover')->getClientOriginalName();

			// dapatkan nama file tanpa ekstensi
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

			// dapatkan ekstensi file
			$extension = $request->file('cover')->getClientOriginalExtension();

			// nama file untuk disimpan
			$filenametostore = md5($getFaqs->translation_of).'.'.$extension;

			//Unggah file
			$request->file('cover')->storeAs($storage, $filenametostore);

			// Ubah ukuran gambar di sini
			$thumbnailpath = public_path($public_path.$filenametostore);
			$img = Image::make($thumbnailpath)->resize(1698, 1698, function($constraint) {
				$constraint->aspectRatio();
			});
			$img->save($thumbnailpath);		
		}
		if($request->hasFile('cover')) {
			$cekFileName=$filenametostore;
		}
		else{			   
			$cekFileName=$getFaqs->picture;
		}
		
		$process = Faq::whereId($id)->first();
		$process->update([        
			'type' =>$request->type,
			'name' => ucwords(strtolower($request->title)),
			'title' => ucwords(strtolower($request->title)),
			'content'=>$dom->saveHTML(),
			'slug' => Str::slug($request->get('title')),
			'picture' => $cekFileName,
			'active' => $request->active
		]);
		if(!$process){
			return back()->with('error', trans('message.Data failed to change'));				
		}
		else{
			return back()->with('success', trans('message.Data successfully changed'));	
		}
    }


   //Delete image summernote
    public function delete_image(){
        $src = $this->input->post('src');
        $file_name = str_replace(base_url(), '', $src);
        if(unlink($file_name))
        {
            echo 'File Delete Successfully';
        }
    }
}
