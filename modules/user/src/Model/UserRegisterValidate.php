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
	  if(!preg_match("/([a-z|A-Z])*/", $value)){

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
	  if($length > 20 || $length < 7){

	  	$errors []= 'Number of characters allowed 7-20';
	  }

	  preg_match("/([a-z|A-Z|1-9|.|\-|_])*@[a-z]*.com/", $value,$matches);

	  if($length != strlen(reset($matches))){
	    $errors []= 'Not valid email';
	  }

	  if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
	    $errors []= 'Not valid email';
	  }
	  return $errors;
	}

	public function validatePhoneNumber($value){
	  $errors = [];
	  $length = strlen($value);

      if(count($_SESSION['phone_number']) > 10){
        $errors []= 'You have exceeded allowed tries for phone number';
      }

	  if($length != 12){

	  	$errors []= 'Must be 12 number only';
	  }
	  if(!preg_match("/9627[0-9]{8}/", $value)){
	    $errors []= 'Not valid jordan mobile number';	
	  }
	  return $errors;
	}

    public function validateSmsCode($value, $mobile){
      $errors = [];

      if($value != $_SESSION['phone_number'][$mobile]['uniSmsCode']){
        $errors []= 'Entered code not matched the sent to that mobile number '.$mobile;

      }else{
        $_SESSION['phone_number'][$mobile]['verified'] = TRUE;
      }
      return $errors;
    }

}