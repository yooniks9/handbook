<?php
	// referrence : https://developer.mailchimp.com/documentation/mailchimp/reference/lists/#%20

	$email = 'myemail@email.com';
	$list_id = 'mailchimp_list_id';
	$api_key = 'mailchimp_api_key';

	$data_center = substr($api_key,strpos($api_key,'-')+1);

	$url = 'https://'. $data_center .'.api.mailchimp.com/3.0/lists/'. $list_id .'/members';
	echo($url);
	$json = json_encode([
	    'email_address' => $email,
	    'status'        => 'subscribed', //pass 'subscribed' or 'unsubscribed'
	]);

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	$result = curl_exec($ch);
	$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	echo $status_code;
?>
