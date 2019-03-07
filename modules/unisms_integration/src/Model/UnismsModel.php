<?php 

namespace App\unisms_integration\Model;

use App\core\Model\BaseModel;

class UnismsModel extends BaseModel{

	private $smsData;

	function __Construct(){
	  $this->smsData = require dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'etc'.DIRECTORY_SEPARATOR.'config.php';
	}


	public function sendCode($arr){

	  $data = [
	  	'AppSid' => $this->smsData['AppSid'],
	  	'SenderID' => $this->smsData['SenderID'],
	  	'Recipient' => $arr['Recipient'],
	  	'Body' => $arr['code'],
	  ];
	  $data_string =  json_encode($data);

	  $curl = curl_init();
	  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
	  
	  curl_setopt($curl, CURLOPT_URL, $this->smsData['url']);
	  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

	  curl_setopt($curl, CURLOPT_HTTPHEADER, [
	  	'Content-Type: application/json',  
	  	'Content-Length: ' . strlen($data_string)]
	  );     
	  
	  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	  $result = curl_exec($curl);

	  return $result;

	  curl_close($curl);
	}

}