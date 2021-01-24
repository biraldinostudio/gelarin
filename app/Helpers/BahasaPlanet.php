<?php
// Buat namespace sesuai folder
//namespace App\Helpers;
use Auth as Auth;
class HelpBahasaPlanet {
    // Sebuah method untuk mencari grade
   /* public static function ParentTrans() {
		$parents = Category::select('name','translation_of','translation_lang')->where('translation_lang', app()->getLocale())->where('parent_id',0)->where('active',1);
        return $parents;
    }    
    public static function CategoryTrans() {
        $categories = Category::select('name','translation_of','translation_lang','parent_id')->where('parent_id','!=',0)->where('translation_lang', app()->getLocale())->where('active',1);
        return $categories;
    }*/


	public static function encrypt_decrypt($action, $string) {
    	$output = false;
    	$encrypt_method = "AES-256-CBC";
    	$secret_key = 'kaye';
    	$secret_iv = 'kaye';
    	// hash
    	$key = hash('sha256', $secret_key);
    
    	// iv - metode enkripsi AES-256-CBC mengharapkan 16 byte - jika tidak Anda akan mendapatkan peringatan
    	$iv = substr(hash('sha256', $secret_iv), 0, 16);
    	if ( $action == 'encrypt' ) {
        	$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        	$output = base64_encode($output);
    	} 
    	else if( $action == 'decrypt' ) {
        	$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    	}
    	return $output;
	}
}