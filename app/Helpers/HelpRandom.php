<?php
//namespace App\Helpers;
class HelpRandom {
	public static function generateRandomString($length = 4) {
		$characters = '0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
    return date("y").date("m").date('d').$randomString;
	}
}