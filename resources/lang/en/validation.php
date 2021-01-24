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
    'maximum salary must be greater than minimum salary.' => 'maximum salary  must be greater than minimum salary.',
    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'The :attribute must be a valid email address.',
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
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
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

	
	/*'custom' => [
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
				'required' => 'Full name is required.',
				'not_in' => 'Full name cannot be empty.',
				'min' => 'Full name must be Minimum :min character.',
				'max' => 'Full name cannot be more than :max character.',			
			],
			'username' => [
				'required' => 'Username is required.',
				'not_in' => 'Username cannot be empty.',
				'min' => 'Username must be Minimum :min character.',
				'max' => 'Username cannot be more than :max character.',
				'unique' => 'Username this is already used.',			
			],	
			'nickname' => [
				'required' => 'Nick name is required.',
				'not_in' => 'Nick name cannot be empty.',
				'min' => 'Nick name must be Minimum :min character.',
				'max' => 'Nick name cannot be more than :max character.',			
			],			
			'email' => [
				'required' => 'Email/Surel is required.',
				'not_in' => 'Email/Surel cannot be empty.',			
				'email' => 'Email/Surel must be a valid email address.',
				'unique' => 'Address Email this is already used.',
			],
			'email1' => [
				'required' => 'Email/Surel is required.',
				'not_in' => 'Email/Surel cannot be empty.',			
				'email' => 'Email/Surel must be a valid email address.',
				'unique' => 'Address Email this is already used.',
			],
			'email2' => [
				'required' => 'Email/Surel is required.',
				'not_in' => 'Email/Surel cannot be empty.',			
				'email' => 'Email/Surel must be a valid email address.',
				'unique' => 'Address Email this is already used.',
			],				
			'countries_phone1' => [
				'required' => 'Region Phone code is required.',
			],		
			'telpcode' => [
				'required' => 'Phone code is required.',
				'min' => 'Phone code Minimum :min character.',
				'max' => 'Phone code cannot be more than :max character.',
				'telpcode' => 'Phone code must be a valid code.',
			],
			'areacode' => [
				'required' => 'Code area is required.',
				'min' => 'Code area Minimum :min character.',
				'max' => 'Code area cannot be more than :max character.',
				'areacode' => 'Code area must be a valid code.',
			],
			'number' => [
				'required' => 'Phone number is required.',
				'min' => 'Phone number Minimum :min character.',
				'max' => 'Phone number cannot be more than :max character.',
				'number' => 'Phone number must be a valid telephone number.',
			],
			'company' => [
				'required' => 'Company name is required.',
				'min' => 'Company name Minimum :min character.',
				'max' => 'Company name cannot be more than :max character.',
			],		
			'gender' => [
				'required' => 'Gender is required.',
				'not_in' => 'Gender is required.',
			],
			'country' => [
				'required' => 'Your country is required.',
				'not_in' => 'Your country is required.',
			],
			'oldpassword' => [
				'required' => 'Old password is required.',
				'exists'=>'sasasasas',
			],
			'newpassword' => [
				'required' => 'New password is required.',
				//'between' => 'Password Minimum :min character and Maximum :max characters.',
				'min' => 'New password Minimum :min character.',
			   'confirmed' => 'Confirmation New password not suitable.',			
			],		
			'password' => [
				'required' => 'Password is required.',
				//'between' => 'Password Minimum :min character and Maximum :max characters.',
				'min' => 'Password Minimum :min character.',
			   'confirmed' => 'Confirmation Password not suitable.',			   
			],
			'password_confirmation' => [
				'required' => 'Confirmation Password is required.',
				'same' => 'Confirmation Password not suitable.',			
			],		
			'g-recaptcha-response' => [
				'required' => 'Incorrect captcha field.',
				'recaptcha' => 'Incorrect captcha field.',
			],
			'term' => [
				'required' => 'You have not agreed to the Terms & Conditions',
				'accepted' => 'You have not agreed to the Terms & Conditions',
			],
			'title' => [
				'required' => 'Subject is required.',
				'between' => 'Subject must be between :min and :max characters.',
				'unique'=>'Subject has already been taken',
				'min' => 'Minimum subject :min character.',
				'max' => 'Maximum subject :max character.',					
			],
			'subject' => [
				'required' => 'Title is required.',
				'not_in' => 'Title is required.',
				'min' => 'Minimum title :min character.',
				'max' => 'Maximum title :max character.',			
				'between' => 'The :attribute must be between :min and :max character.',
			],
			'parent' => [
				'required' => 'The category is required.',
				'not_in' => 'The category is required.',
			],		
			'description' => [
				'required' => 'Description is required.',
				'not_in' => 'Description is required.',			
				'min' => 'Minimum description :min character.',
				'max' => 'Maximum description :max character.',			
				'between' => 'The :attribute must be between :min and :max character.',
			],
			'detail' => [
				'required' => 'Detail is required.',
				'not_in' => 'Detail is required.',			
				'min' => 'Minimum detail :min character.',
				'max' => 'Maximum detail :max character.',			
				'between' => 'The :attribute must be between :min and :max character.',
			],			
			'salary' => [
				'required' => 'Salary is required.',
			],
			'resume' => [
				'required_if' => 'Your resume is required.',
				'mimes' => 'Your resume this must be formats: :mimes.',
			],
			'location' => [
				'required' => 'Area is required.',
				'not_in' => 'Area is required.',
			],
			'address' => [
				'required' => 'Address is required.',
				'not_in' => 'Address is required.',
				'max' => ':attribute maybe not bigger than :max characters.',			
			],
			'postal_code' => [
				'required' => 'Postal code is required.',
				'not_in' => 'Postal code is required.',	
			],		
			'subadmin1' => [
				'required' => 'Region is required.',
				'not_in' => 'Region is required.',
			],
			'cit' => [
				'required' => 'Location is required.',
				'not_in' => 'location is required.',
			],
			'type' => [
				'required' => 'Type is required.',
				'not_in' => 'Type is required.',
			],
			'level' => [
				'required' => 'Level is required.',
				'not_in' => 'Level is required.',
			],
			'category' => [
				'required' => 'Category is required.',
				'not_in' => 'Category is required.',
			],	
			'start_date' => [
				'required' => 'Start date is required.',
				'not_in' => 'Start date is required.',
			],
			'end_date' => [
				'required' => 'End date is required.',
				'not_in' => 'End date is required.',
			   //'after' => 'Must be more than the start date.',
				'after' => 'Must be more than the current date.',			   
			   'date' => 'Not a valid date.'	   
			],
			'position' => [
				'required' => 'Job position is required.',
				'not_in' => 'Job position is required.',
			],			
			'start' => [
				'required' => 'Start date is required.',
				'not_in' => 'Start date is required.',
			],
			'last' => [
				'required' => 'End date is required.',
				'not_in' => 'End date is required.',
			   //'after' => 'Must be more than the start date.',
				'after' => 'Must be more than a start date.',			   
			   'date' => 'Not a valid date.'	   
			],
			'start_year' => [
				'required' => 'Start year is required.',
				'not_in' => 'Start year is required.',
			],
			'last_year' => [
				'required' => 'Final year is required.',
				'not_in' => 'Final year is required.',
			   //'after' => 'Must be more than the start date.',
				'after' => 'Must be more than a start year.',			   
			   'date' => 'Not a valid date.'	   
			],			
			'major' => [
				'required' => 'Major is required.',
				'not_in' => 'Major is required.',			
				'min' => 'Minimum major :min character.',
				'max' => 'Maximum major :max character.',			
				'between' => 'The :attribute must be between :min and :max character.',
			],
			'school' => [
				'required' => 'School is required.',
				'not_in' => 'School is required.',			
				'min' => 'Minimum school :min character.',
				'max' => 'Maximum school :max character.',			
				'between' => 'The :attribute must be between :min and :max character.',
			],			
			'educatione' => [
				'required' => 'Education is required.',
				'not_in' => 'Education is required.',
			],
			'majorne' => [
				'required' => 'Department is required.',
				'not_in' => 'Department is required.',
			],		
			'experience' => [
				'required' => 'Experience is required.',
				'not_in' => 'Experience is required.',
			],
			'age' => [
				'required' => 'Age is required.',
				'numeric' => 'Fill in the numbers.',
				'min' => 'Minimum age :min year.',
				'max' => 'Maximum age :max year.',				
			],		
			'min_salary' => [
				'required' => 'Minimum Salary is required.',
				'not_in' => 'Minimum Salary is required.',
				'regex' => 'Fill in the numbers.',
			   // 'between' => 'Salary Minimum .',				
			],
			'max_salary' => [
				'required' => 'Maximum Salary is required.',
				'not_in' => 'Maximum Salary is required.',	
				'regex' => 'Fill in the numbers.',			
			],
			'salary' => [
				'required' => 'Jenis Salary is required.',
				'not_in' => 'Jenis Salary is required.',
			],
			'url' => [
				//'regex' => 'URl tidak valid.',
				'min' => 'Minimum :min character.',
				'max' => 'Maximum :max character.',				
			],
			'reason' => [
				'required' => 'Reason is required.',
			],
			'value' => [
				'required' => 'Value is required.',
				'not_in' => 'Value is required.',
			],				
			'comment' => [
				'required' => 'Comment is required.',
				'not_in' => 'Comment is required.',
				'min' => 'Minimum comment :min character.',
				'max' => 'Maximum comment :max character.',			
				'between' => 'The :attribute must be between :min and :max character.',
			],
			'aboutme' => [
				'required' => 'Aboutme is required.',
				'not_in' => 'Aboutme is required.',			
				'min' => 'Minimum aboutme :min character.',
				'max' => 'Maximum aboutme :max character.',			
				'between' => 'The :attribute must be between :min and :max character.',
			],
			'profession' => [
				'required' => 'Profession is required.',
				'not_in' => 'Profession is required.',			
				'min' => 'Minimum profession :min character.',
				'max' => 'Maximum profession :max character.',			
				'between' => 'The :attribute must be between :min and :max character.',
			],
			'size' => [
				'required' => 'Size is required.',
				'not_in' => 'Size is required.',			
				'min' => 'Minimum size :min character.',
				'max' => 'Maximum size :max character.',			
				'between' => 'The :attribute must be between :min and :max character.',
			],
			'skill' => [
				'required' => 'Skill is required.',
				'not_in' => 'Skill is required.',			
				'min' => 'Minimum skill :min character.',
				'max' => 'Maximum skill :max character.',			
				'between' => 'The :attribute must be between :min and :max character.',
			],
			'jun_sch_name' => [
				'required' => 'Junior school name is required.',
				'not_in' => 'Junior school name is required.',			
				'min' => 'Minimum junior school name :min character.',
				'max' => 'Maximum junior school name :max character.',			
				'between' => 'The :attribute must be between :min and :max character.',
			],
			'sen_sch_name' => [
				'required' => 'Senior school name is required.',
				'not_in' => 'Senior school name is required.',			
				'min' => 'Minimum senior school name :min character.',
				'max' => 'Maximum senior school name :max character.',			
				'between' => 'The :attribute must be between :min and :max character.',
			],
			'start_edujun' => [
				'required' => 'Start year is required.',
				'not_in' => 'Start year is required.',
			],
			'last_edujun' => [
				'required' => 'Final year is required.',
				'not_in' => 'Final year is required.',
			   //'after' => 'Must be more than the start date.',
				'after' => 'Must be more than a start year.',			   
			   'date' => 'Not a valid date.'	   
			],
			'start_edusen' => [
				'required' => 'Start year is required.',
				'not_in' => 'Start year is required.',
			],
			'last_edusen' => [
				'required' => 'Final year is required.',
				'not_in' => 'Final year is required.',
			   //'after' => 'Must be more than the start date.',
				'after' => 'Must be more than a start year.',			   
			   'date' => 'Not a valid date.'	   
			],
			'photo' => [
				'required' => 'Your photo is required.',
				'mimes' => 'Your photo this must be formats :mimes.',
				'max' => 'Photo size cannot be greater than :max.',				
			],
			'message' => [
				'required' => 'Message is required.',
				'not_in' => 'Message is required.',				
				'min' => 'Minimum message :min character.',
				'max' => 'Maximum message :max character.',				
			],					
			
		],
	'You can only change and add, but can\'t delete'=>'You can only change and add, but can\'t delete',
	'Only replace and add, cannot delete'=>'Only replace and add, cannot delete',
];
