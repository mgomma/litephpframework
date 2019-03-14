<?php 
namespace App\user\Model;

use App\core\Model\BaseModel;
use App\unisms_integration\Model\UnismsModel;
use App\user\Model\UserRegisterValidate;

class UserRegisterModel extends BaseModel{

	private $smsModel;
	private $userRegisterValidate;
	private $state;

	const table = 'user';

	const fields = ['first_name', 'last_name', 'email', 'phone_number', 'phone_verified', 'status', 'created', 'changed'];

	function __Construct(){
	  parent::__Construct();

	  $this->smsModel = new UnismsModel();
	  $this->userRegisterValidate = new UserRegisterValidate();

	  $this->state = [];
	}

	public function getFields(){
	  return SELF::fields;
	}

	public function saveUser(&$arr, $update = FALSE){
	  $fields = array_intersect($arr, SELF::fields);

	  if(!$update){
	    $fields['created'] = time();
        $fields['changed'] = NULL;
      }
	  $this->insert(SELF::table, $fields);
	}

	public function validate(&$arr){
	  $this->state['first_name'] = $this->userRegisterValidate->validateName($arr['first_name']);
	  $this->state['last_name'] = $this->userRegisterValidate->validateName($arr['last_name']);

	  $this->state['email'] = $this->userRegisterValidate->validateEmail($arr['email']);
	  $this->state['phone_number'] = $this->userRegisterValidate->validatePhoneNumber($arr['phone_number']);

	  if(isset($_SESSION['uniSmsCode']) && isset($arr['sms_code'])){
        $this->state['sms_code'] = $this->userRegisterValidate->validateSmsCode($arr['sms_code']);
      }
	}

	public function getModelState(){
	  return $this->state;
	}

	public function hasErrors(){
	  return (bool) count(array_filter($this->state));
	}

	public function sendCode($mobile){
	  $code = $this->GenerateSmsCode($mobile);

	  $arr = ['code' => $_SESSION['uniSmsCode'], 'Recipient' => $mobile];
	  $this->smsModel->sendCode($arr);
	}

	public function GenerateSmsCode($mobile){
	  mt_srand($mobile);

      $_SESSION['uniSmsCode'] = mt_rand(1000, 9999);
      $_SESSION['uniSmsSendTime'] = time();

      if(isset($_SESSION['uniSmsSendCounter'])){
        $_SESSION['uniSmsSendCounter'] += 1;

      }else{
      	$_SESSION['uniSmsSendCounter'] = 1;
      }
	}
}