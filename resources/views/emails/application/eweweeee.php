<?php       
        
		$existing=UserDescription::where('user_id',$userId)->first();
        if($request->hasFile('photo')) {
            $storage="public/uploads/company/photo/";
            $public_path="storage/uploads/company/photo/";

            //Tahun dan bulan untuk DB
            $datefile_todb=date("Y").'/'.date("m").'/';

            //Pembuatan Direktori
            $year_storage = $storage . date("Y");
            $year_publicpath = $public_path . date("Y");
            $month_storage = $year_storage . '/' . date("m").'/';
            $month_publicpath = $year_publicpath . '/' . date("m").'/';  
            !file_exists($year_publicpath) && mkdir($year_publicpath , 0777);
            !file_exists($month_publicpath) && mkdir($month_publicpath, 0777);
            
            //Hapus file lama
            if(\File::exists($public_path.$existing->photo)){
                \File::delete($public_path.$existing->photo);
            } 
            //User ID untuk selip di nama file
            $userid_file=$existing->user_id;

            // dapatkan nama file dengan ekstensi
            $filenamewithextension = $request->file('photo')->getClientOriginalName();

            // dapatkan nama file tanpa ekstensi
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            // dapatkan ekstensi file
            $extension = $request->file('photo')->getClientOriginalExtension();

            // nama file untuk disimpan
            $filenametostore = $filename.'_'.time().$userid_file.$userid_file.'.'.$extension;

            //Unggah file
            $request->file('photo')->storeAs($month_storage, $filenametostore);

            // Ubah ukuran gambar di sini
            $thumbnailpath = public_path($month_publicpath.$filenametostore);
            $img = Image::make($thumbnailpath)->resize(150, 150, function($constraint) {
                $constraint->aspectRatio();
            });
           $img->save($thumbnailpath);   
        }