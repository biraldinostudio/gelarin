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
use App\Models\Page;
use Route;
class PageController extends Controller
{
    public function __construct(){
        $this->middleware('auth:adminMiddle');
    }
	
    public function index()
    {
		if(Route::is('admin.page.active')){
		$pages=Page::whereActive('1')->where('translation_lang', app()->getLocale())->paginate(5);
			}
		if(Route::is('admin.page.inactive')){
		$pages=Page::whereActive('0')->where('translation_lang', app()->getLocale())->paginate(5);
		}
		return view('admin.page.index')->with(compact('pages'));
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
		$pages=Page::find($id);
		return view('admin.page.edit')->with(compact('pages'));
    }

    public function update(Request $request, $id)
    {
		$getPages=Page::whereId($id)->first();
		Validator::make($request->all(), [
			'type' => 'required',
           	'title'=> 'required',
			'description'=> 'required|string|min:15|max:255',			
           	'position'=> 'required',
           	'keyword'=> 'required|string|min:20|max:255',
           	'content'=> 'required|string|min:200|max:1000000',
            'active'=> 'required',			
        ])->validate();

        $storage="storage/uploads/page/content/";
        $public_path="storage/uploads/page/content/";
		
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
				$filenameRand = 'Content'.'_'.$getPages->id.'_'.substr(md5($filename),6,6).'_'.time();						

				if($getPages->content!=$request->content){
					$filepath = ("$public_path/$filenameRand.$mimetype");
					$image=Image::make($src)
						//->resize(1200, 1200)
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
			$storage="public/uploads/page/";
			$public_path="storage/uploads/page/";

			//Hapus file lama
			if(\File::exists($public_path.$getPages->picture)){
				\File::delete($public_path.$getPages->picture);
			}

			// dapatkan nama file dengan ekstensi
			$filenamewithextension = $request->file('cover')->getClientOriginalName();

			// dapatkan nama file tanpa ekstensi
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

			// dapatkan ekstensi file
			$extension = $request->file('cover')->getClientOriginalExtension();

			// nama file untuk disimpan
			$filenametostore = md5($filename).'.'.$extension;

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
			$cekFileName=$getPages->picture;
		}
		
		$process = Page::whereId($id)->first();
		$process->update([        
			'type' =>$request->type,
			'name' => ucwords(strtolower($request->title)),
			'description' => $request->description,
			'keyword' => $request->keyword,
			'title' => ucwords(strtolower($request->title)),
			'content'=>$dom->saveHTML(),
			'slug' => $request->type,
			'link' => $request->url,
			'picture' => $cekFileName,
			'position' => $request->position,
			'active' => $request->active
		]);
		if(!$process){
			return back()->with('error', trans('message.Data failed to change'));				
		}
		else{
			return back()->with('success', trans('message.Data successfully changed'));	
		}
    }
    public function destroy($id)
    {
        //
    }
}
