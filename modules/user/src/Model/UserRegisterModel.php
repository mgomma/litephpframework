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
	   $this->buildSaveArr($arr, $update = FALSE);

      return $this->insert(SELF::table, $arr);
	}

	private function buildSaveArr(&$arr, $update = FALSE){
        foreach ($arr as $k => $v) {

          if($key = 'created' || $key = 'changed'){
              unset($arr[$k]);
          }
          if (!in_array($k, SELF::fields)) {
            unset($arr[$k]);

          }
        }
    }

	public function validate(&$arr){
	  $this->state['first_name'] = $this->userRegisterValidate->validateName($arr['first_name']);
	  $this->state['last_name'] = $this->userRegisterValidate->validateName($arr['last_name']);

	  $this->state['email'] = $this->userRegisterValidate->validateEmail($arr['email']);
	  $this->state['phone_number'] = $this->userRegisterValidate->validatePhoneNumber($arr['phone_number']);

	  if(isset($_SESSION['phone_number'][$arr['phone_number']]) && isset($arr['sms_code'])){
        $this->state['sms_code'] = $this->userRegisterValidate->validateSmsCode($arr['sms_code'], $arr['phone_number']);
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

	  if($GLOBALS['env']['mode'] != 'prod'){
         $arr = ['code' => $_SESSION['phone_number'][$mobile]['uniSmsCode'], 'Recipient' => $mobile];

         if($this->smsModel->sendCode($arr)){
           $_SESSION['phone_number'][$mobile]['uniSmsSendTime'] = time();
         }
      }else{
        $_SESSION['phone_number'][$mobile]['uniSmsSendTime'] = time();
      }
	}

	public function GenerateSmsCode($mobile){
	  mt_srand($mobile);

      $_SESSION['phone_number'][$mobile]['uniSmsCode'] = mt_rand(1000, 9999);

      if(isset($_SESSION['phone_number'][$mobile]['uniSmsSendCounter'])){
        $_SESSION['phone_number'][$mobile]['uniSmsSendCounter'] += 1;

      }else{
      	$_SESSION['phone_number'][$mobile]['uniSmsSendCounter'] = 1;
      }
	}
}