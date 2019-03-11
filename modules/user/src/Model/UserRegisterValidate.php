<?php 
namespace App\user\Model;

use App\core\Model\BaseValidate;

class UserRegisterValidate extends BaseValidate{

	private $errors;

	function __Construct(){
		$this->errors = [];
	}

	public function validateName($value){
	  $errors = [];
	  if(!preg_match("/^[a-zA-Z]+$/", $value)){

	  	$errors []= 'Alphabetical only';
	  }
	  $length = strlen($value);
	  if($length > 20 || $length < 2){

	  	$errors []= 'Number of letters allowed 2-20';
	  }
	  return $errors;
	}

	public function validateEmail($value){
	  $errors = [];

	  $length = strlen($value);
	  $atPos = strrpos($value, '@');
	  $dotPos = strrpos($value, '.');

	  $dotCom = substr($value, $dotPos);
	  $domain = substr($value, $atPos+1, $dotPos - $atPos-1);
	  $start = substr($value, 0, $atPos);
	  //print_r([$dotCom, $domain, $start]); exit;
	  if($dotCom != '.com'){

	  	$errors []= 'Only .com domains allowed';
	  }
	  if(!preg_match('/(a-z)/', $domain)){

	  	$errors []= 'Only lower case letters domains allowed';
	  }
	  if(!preg_match('/(a-z|A-Z|1-9|.-_)/', $start)){

	  	$errors []= 'Only lower case letters domains allowed';
	  }
	  $length = strlen($value);
	  if($length > 20 || $length < 7){

	  	$errors []= 'Number of characters allowed 7-20';
	  }
	  return $errors;
	}

	public function validatePhoneNumber($value){
	  $errors = [];
	  $length = strlen($value);
	  if($length != 12){

	  	$errors []= 'Must be 12 number only';
	  }
	  if(!preg_match("/9627(0-9)/", $value)){
	    $errors []= 'Not valid jordan mobile number';	
	  }
	  return $errors;
	}

}