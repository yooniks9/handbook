<?php
	public static function curl($url){
		$username = "USERNAME";
		$password = "PASSWORD";

		$header = array();
		$header[] = "Authorization: Basic ".base64_encode($username.":".$password);
		$header[] = "Content-Type: application/json";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		$data = curl_exec($ch);
		curl_close ($ch);
		$data = json_decode($data);

		return $data;
	}
?>