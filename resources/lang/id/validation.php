<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'maximum salary must be greater than minimum salary.' => 'maksimal gaji harus lebih besar dari minimum gaji.',
    'accepted'             => ' :attribute harus diterima.',
    'active_url'           => ' :attribute bukan URL yang valid.',
    'after'                => ' :attribute harus jadi sebelum tanggal :date.',
    'after_or_equal'       => ' :attribute harus tanggal setelah atau sama dengan :date.',
    'alpha'                => ' :attribute hanya boleh berisi huruf.',
    'alpha_dash'           => ' :attribute hanya boleh berisi huruf, angka, dan tanda hubung.',
    'alpha_num'            => ' :attribute may only contain letters and numbers.',
    'array'                => ' :attribute must be an array.',
    'before'               => ' :attribute must be a date before :date.',
    'before_or_equal'      => ' :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => ':attribute tidak sesuai dengan format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => ' :attribute harus  e-mail yang valid.',
    'exists'               => 'The selected :attribute is invalid.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => ' :attribute may not be greater than :max.',
        'file'    => ' :attribute may not be greater than :max kilobytes.',
        'string'  => ' :attribute may not be greater than :max karakter.',
        'array'   => ' :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => ' :attribute setidaknya harus :min.',
        'file'    => ' :attribute setidaknya harus :min kilobytes.',
        'string'  => ' :attribute setidaknya harus :min karakter.',
        'array'   => ' :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => ' :attribute wajib diisi.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',
    'check_password'                  => 'Kata sandi lama tidak dikenali.',	

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

   /* 'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],*/

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],
'custom' => [			
        'name' => [
            'required' => 'Nama lengkap wajib diisi.',
            'not_in' => 'Nama lengkap tidak boleh kosong.',
            'min' => 'Nama lengkap harus minimal :min karakter.',
            'max' => 'Nama lengkap tidak boleh lebih dari :max karakter.',			
        ],
        'username' => [
            'required' => 'Username wajib diisi.',
            'not_in' => 'Username tidak boleh kosong.',
            'min' => 'Username harus minimal :min karakter.',
            'max' => 'Username tidak boleh lebih dari :max karakter.',
            'unique' => 'Username ini sudah digunakan.',			
        ],	
        'nickname' => [
            'required' => 'Nama panggilan wajib diisi.',
            'not_in' => 'Nama panggilan tidak boleh kosong.',
            'min' => 'Nama panggilan harus minimal :min karakter.',
            'max' => 'Nama panggilan tidak boleh lebih dari :max karakter.',			
        ],			
        'email' => [
            'required' => 'Email/Surel wajib diisi.',
            'not_in' => 'Email/Surel tidak boleh kosong.',			
            'email' => 'Email/Surel harus alamat email yang valid.',
            'unique' => 'Alamat Email ini sudah digunakan.',
        ],			
        'email1' => [
            'required' => 'Email/Surel wajib diisi.',
            'not_in' => 'Email/Surel tidak boleh kosong.',			
            'email' => 'Email/Surel harus alamat email yang valid.',
            'unique' => 'Alamat Email ini sudah digunakan.',
        ],			
        'email2' => [
            'required' => 'Email/Surel wajib diisi.',
            'not_in' => 'Email/Surel tidak boleh kosong.',			
            'email' => 'Email/Surel harus alamat email yang valid.',
            'unique' => 'Alamat Email ini sudah digunakan.',
        ],		
        'countries_phone1' => [
            'required' => 'Region kode telepon wajib diisi.',
        ],		
        'telpcode' => [
            'required' => 'Kode telepon wajib diisi.',
            'min' => 'Kode telepon minimal :min karakter.',
            'max' => 'Kode telepon tidak boleh lebih dari :max karakter.',
            'telpcode' => 'Kode telepon harus kode yang valid.',
        ],
        'areacode' => [
            'required' => 'Kode area wajib diisi.',
            'min' => 'Kode area minimal :min karakter.',
            'max' => 'Kode area tidak boleh lebih dari :max karakter.',
            'areacode' => 'Kode area harus kode yang valid.',
        ],
        'number' => [
            'required' => 'No telepon wajib diisi.',
            'min' => 'No telepon minimal :min karakter.',
            'max' => 'No telepon tidak boleh lebih dari :max karakter.',
            'number' => 'No telepon harus nomor telepon yang valid.',
        ],
        'company' => [
            'required' => 'Nama perusahaan wajib diisi.',
            'min' => 'Nama perusahaan minimal :min karakter.',
            'max' => 'Nama perusahaan tidak boleh lebih dari :max karakter.',
        ],		
        'gender' => [
            'required' => 'Jenis kelamin wajib diisi.',
            'not_in' => 'Jenis kelamin wajib diisi.',
        ],
        'country' => [
            'required' => 'Negara Anda wajib diisi.',
            'not_in' => 'Negara Anda wajib diisi.',
        ],
        'oldpassword' => [
            'required' => 'Kata sandi lama wajib diisi.',
			'exists'=>'sasasasas',
        ],
        'newpassword' => [
            'required' => 'Kata sandi baru wajib diisi.',
            //'between' => 'Kata sandi minimal :min karakter dan maksimal :max characters.',
			'min' => 'Kata sandi baru minimal :min karakter.',
           'confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',			
        ],		
        'password' => [
            'required' => 'Kata sandi wajib diisi.',
            //'between' => 'Kata sandi minimal :min karakter dan maksimal :max characters.',
			'min' => 'Kata sandi minimal :min karakter.',
           'confirmed' => 'Konfirmasi kata sandi tidak cocok.',			   
        ],
        'password_confirmation' => [
            'required' => 'Konfirmasi kata sandi wajib diisi.',
            'same' => 'Konfirmasi kata sandi tidak cocok.',			
        ],		
        'g-recaptcha-response' => [
            'required' => 'Bidang captcha tidak benar.',
            'recaptcha' => 'Bidang captcha tidak benar.',
        ],
        'term' => [
            'required' => 'Anda belum menyetujui Syarat & Ketentuan',
            'accepted' => 'Anda belum menyetujui Syarat & Ketentuan',
        ],
        'title' => [
            'required' => 'Judul wajib diisi.',
			'unique'=>'Judul ini sudah dipakai',
            'min' => 'Judul minimal :min karakter.',
            'max' => 'Judul maksimal :max karakter.',
            'between' => 'Judul harus antara :min dan :max karakter.',			
        ],
        'subject' => [
            'required' => 'Judul wajib diisi.',
            'not_in' => 'Judul wajib diisi.',
            'min' => 'Judul minimal :min karakter.',
            'max' => 'Judul maksimal :max karakter.',			
            'between' => ':attribute harus antara :min dan :max karakter.',
        ],
        'parent' => [
            'required' => 'Kategori yang wajib diisi.',
            'not_in' => 'Kategori yang wajib diisi.',
        ],		
        'description' => [
            'required' => 'Deskripsi wajib diisi.',
            'not_in' => 'Deskripsi wajib diisi.',			
            'min' => 'Deskripsi minimal :min karakter.',
            'max' => 'Deskripsi maksimal :max karakter.',			
            'between' => ':attribute harus antara :min dan :max karakter.',
        ],
        'detail' => [
            'required' => 'Detail wajib diisi.',
            'not_in' => 'Detail wajib diisi.',			
            'min' => 'Detail minimal :min karakter.',
            'max' => 'Detail maksimal :max karakter.',			
            'between' => ':attribute harus antara :min dan :max karakter.',
        ],
        'salary' => [
            'required' => 'Gaji wajib diisi.',
        ],
        'resume' => [
            'required' => 'Resume Anda wajib diisi.',
            'mimes' => 'resume Anda harus ini formats: :mimes.',
        ],
        'location' => [
            'required' => 'Daerah wajib diisi.',
            'not_in' => 'Daerah wajib diisi.',
        ],
        'address' => [
            'required' => 'Alamat wajib diisi.',
            'not_in' => 'Alamat wajib diisi.',
            'max' => ':attribute mungkin tidak lebih besar dari :max characters.',			
        ],
        'postal_code' => [
            'required' => 'Kode pos wajib diisi.',
            'not_in' => 'Kode pos wajib diisi.',	
        ],		
        'subadmin1' => [
            'required' => 'Wilayah wajib diisi.',
            'not_in' => 'Wilayah wajib diisi.',
        ],
        'cit' => [
            'required' => 'Lokasi wajib diisi.',
            'not_in' => 'lokasi wajib diisi.',
        ],
        'type' => [
            'required' => 'Jenis wajib diisi.',
            'not_in' => 'Jenis wajib diisi.',
        ],
        'level' => [
            'required' => 'Tingkat wajib diisi.',
            'not_in' => 'Tingkat wajib diisi.',
        ],
        'category' => [
            'required' => 'Category wajib diisi.',
            'not_in' => 'Category wajib diisi.',
        ],	
        'start_date' => [
            'required' => 'Tanggal mulai wajib diisi.',
            'not_in' => 'Tanggal mulai wajib diisi.',
        ],
        'end_date' => [
            'required' => 'Tanggal akhir wajib diisi.',
            'not_in' => 'Tanggal akhir wajib diisi.',
           //'after' => 'Harus lebih dari tanggal mulai.',
		   'after' => 'Harus lebih dari tanggal sekarang.',
           'date' => 'Bukan tanggal yang valid.'	   
        ],
        'position' => [
            'required' => 'Jabatan wajib diisi.',
            'not_in' => 'Jabatan wajib diisi.',
        ],		
        'start' => [
            'required' => 'Tanggal mulai wajib diisi.',
            'not_in' => 'Tanggal mulai wajib diisi.',
        ],
        'last' => [
            'required' => 'Tanggal akhir wajib diisi.',
            'not_in' => 'Tanggal akhir wajib diisi.',
           //'after' => 'Harus lebih dari tanggal mulai.',
		   'after' => 'Harus lebih dari tanggal mulai',
           'date' => 'Bukan tanggal yang valid.'	   
        ],
        'start_year' => [
            'required' => 'Tahun mulai wajib diisi.',
            'not_in' => 'Tahun mulai wajib diisi.',
        ],
        'last_year' => [
            'required' => 'Tahun selesai wajib diisi.',
            'not_in' => 'Tahun selesai wajib diisi.',
           //'after' => 'Harus lebih dari tanggal mulai.',
		   'after' => 'Harus lebih dari tahun mulai',
           'date' => 'Bukan tahun yang valid.'	   
        ],		
        'major' => [
            'required' => 'Jurusan wajib diisi.',
            'not_in' => 'Jurusan wajib diisi.',			
            'min' => 'Jurusan minimal :min karakter.',
            'max' => 'Jurusan maksimal :max karakter.',			
            'between' => ':attribute harus antara :min dan :max karakter.',
        ],
        'school' => [
            'required' => 'Sekolah wajib diisi.',
            'not_in' => 'Sekolah wajib diisi.',			
            'min' => 'Sekolah minimal :min karakter.',
            'max' => 'Sekolah maksimal :max karakter.',			
            'between' => ':attribute harus antara :min dan :max karakter.',
        ],		
        'educatione' => [
            'required' => 'Pendidikan wajib diisi.',
            'not_in' => 'Pendidikan wajib diisi.',
        ],
        'majorne' => [
            'required' => 'Jurusan wajib diisi.',
            'not_in' => 'Jurusan wajib diisi.',
        ],		
        'experience' => [
            'required' => 'Pengalaman wajib diisi.',
            'not_in' => 'Pengalaman wajib diisi.',
        ],
        'age' => [
            'required' => 'Umur wajib diisi.',
            'numeric' => 'Isi angka.',
            'min' => 'Umur minimal :min tahun.',
            'max' => 'Umur maximal :max tahun.',				
        ],		
        'min_salary' => [
            'required' => 'Minimal gaji wajib diisi.',
            'not_in' => 'Minimal gaji wajib diisi.',
            'regex' => 'Isi angka.',
           // 'between' => 'Gaji minimal .',				
        ],
        'max_salary' => [
            'required' => 'Maksimal gaji wajib diisi.',
            'not_in' => 'Maksimal gaji wajib diisi.',	
            'regex' => 'Isi angka.',			
        ],
        'salary' => [
            'required' => 'Jenis gaji wajib diisi.',
            'not_in' => 'Jenis gaji wajib diisi.',
        ],
        'url' => [
            //'regex' => 'URl tidak valid.',
            'min' => 'Minimal :min karakter.',
            'max' => 'Maksimal :max karakter.',				
        ],
        'reason' => [
            'required' => 'Alasan wajib diisi.',
        ],
		'value' => [
			'required' => 'Nilai tidak boleh kosong.',
			'not_in' => 'Nilai tidak boleh kosong.',
		],				
		'comment' => [
			'required' => 'Komentar tidak boleh kosong.',
			'not_in' => 'Komentar tidak boleh kosong.',
			'min' => 'Komentar minimal :min karakter.',
			'max' => 'Komentar maksimal :max karakter.',			
			'between' => 'Komentar harus antara :min dan :max karakter.',
		],
		'aboutme' => [
			'required' => 'Deskripsi tentang anda wajib diisi.',
			'not_in' => 'Deskripsi tentang anda wajib diisi.',			
			'min' => 'Deskripsi tentang anda minimal :min karakter.',
			'max' => 'Deskripsi tentang anda :max karakter.',			
			'between' => 'Deskripsi tentang anda harus antara :min and :max karakter.',
		],
		'profession' => [
			'required' => 'Profesi wajib diisi.',
			'not_in' => 'Profesi wajib diisi.',			
			'min' => 'Profesi minimal :min karakter.',
			'max' => 'Profesi :max karakter.',			
			'between' => 'Profesi harus antara :min and :max karakter.',
		],
		'size' => [
			'required' => 'Ukuran wajib diisi.',
			'not_in' => 'Ukuran wajib diisi.',			
			'min' => 'Ukuran minimal :min karakter.',
			'max' => 'Ukuran :max karakter.',			
			'between' => 'Ukuran harus antara :min and :max karakter.',
		],
		'skill' => [
			'required' => 'Keahlian wajib diisi.',
			'not_in' => 'Keahlian wajib diisi.',			
			'min' => 'Keahlian minimal :min karakter.',
			'max' => 'Keahlian :max karakter.',			
			'between' => 'Keahlian harus antara :min and :max karakter.',
		],
		'jun_sch_name' => [
			'required' => 'Sekolah menengah pertama wajib diisi.',
			'not_in' => 'Sekolah menengah pertama wajib diisi.',			
			'min' => 'Sekolah menengah pertama minimal :min karakter.',
			'max' => 'Sekolah menengah pertama :max karakter.',			
			'between' => 'Sekolah menengah pertama harus antara :min and :max karakter.',
		],
		'sen_sch_name' => [
			'required' => 'Sekolah menengah atas wajib diisi.',
			'not_in' => 'Sekolah menengah atasa wajib diisi.',			
			'min' => 'Sekolah menengah atas minimal :min karakter.',
			'max' => 'Sekolah menengah atas :max karakter.',			
			'between' => 'Sekolah menengah atas harus antara :min and :max karakter.',
		],
        'start_edujun' => [
            'required' => 'Tahun mulai wajib diisi.',
            'not_in' => 'Tahun mulai wajib diisi.',
        ],
        'last_edujun' => [
            'required' => 'Tahun selesai wajib diisi.',
            'not_in' => 'Tahun selesai wajib diisi.',
           //'after' => 'Harus lebih dari tanggal mulai.',
		   'after' => 'Harus lebih dari tahun mulai',
           'date' => 'Bukan tahun yang valid.'	   
        ],
        'start_edusen' => [
            'required' => 'Tahun mulai wajib diisi.',
            'not_in' => 'Tahun mulai wajib diisi.',
        ],
        'last_edusen' => [
            'required' => 'Tahun selesai wajib diisi.',
            'not_in' => 'Tahun selesai wajib diisi.',
           //'after' => 'Harus lebih dari tanggal mulai.',
		   'after' => 'Harus lebih dari tahun mulai',
           'date' => 'Bukan tahun yang valid.'	   
        ],
        'photo' => [
            'required' => 'Foto Anda wajib diisi.',
            'mimes' => 'Foto Anda harus ini formats :mimes.',
			'max'=>'Ukuran foto Anda tidak boleh lebih dari :max',
        ],
        'message' => [
            'required' => 'Isi pesan wajib diisi.',
            'not_in' => 'Isi pesan wajib diisi.',          
            'min' => 'Isi Pesan minimal :min karakter.',
            'max' => 'Isi pesan maksimal :max karakter.',
        ],        	
    ],
	'You can only change and add, but can\'t delete'=>'Anda hanya bisa mengganti dan menambah, tapi tidak bisa menghapus',
	'Only replace and add, cannot delete'=>'Hanya mengganti dan menambah, tidak bisa menghapus',
];
