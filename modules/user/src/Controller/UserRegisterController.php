<?php 
namespace App\user\Controller;

use App\core\Controller\BaseFrontController;
use App\user\Form\RegisterForm;
use App\user\Model\UserRegisterModel;

class UserRegisterController extends BaseFrontController{

	private $model;
	private $form;

	function __Construct(){
	  parent::__Construct();	
	  $this->model = new UserRegisterModel();
      $this->form = new RegisterForm();

      $this->data['style'] []= ['url' => '/modules/user/assets/css/userregisterstyle.css'];
      $this->data['script'] []= ['url' => '/modules/user/assets/js/userregisterscript.js'];

	}

	public function index(){
	  if($this->request->isPost()){

	  	$this->registerFormSubmit();
	  }else{
          $_SESSION['phone_number'] = [];

          $this->returnRegisterForm([]);
	  }
	}

	private function registerFormSubmit(){
	  $post = $this->request->post();

	  $this->model->validate($post);
	  $state = $this->model->getModelState();

	  $mobile = $post['phone_number'];
      $formState = [];

	  if(!$this->model->hasErrors() && !isset($_SESSION['phone_number'][$mobile]['uniSmsCode'])){
	    $this->model->sendCode($mobile);
      }

	  if($this->model->hasErrors() || !isset($_SESSION['phone_number'][$mobile]['verified'])){
	  	foreach ($post as $key => $value) {

	  	  $formState[$key]['value'] = $value;
	  	  if(isset($state[$key])){

	  	    $formState[$key]['errors'] = $state[$key];
	  	  }
	  	}

        $this->returnRegisterForm($formState);
	  }

	  if(isset($_SESSION['phone_number'][$mobile]['verified']) && $_SESSION['phone_number'][$mobile]['verified']){
        $post['phone_verified'] = $_SESSION['phone_number'][$mobile]['verified'];

	    return $this->submitUser($post);
      }

	}

	private function submitUser(&$arr){
	    if($this->model->saveUser($arr)){
            unset($_SESSION['phone_number']);

	        $this->data['register_result']['message'] = 'You have registered Successfully !!';
            $this->data['register_result']['type'] = 'success';

        }else{
            $this->data['register_result']['message'] = 'An error occured  .please try again';
            $this->data['register_result']['type'] = 'error';
        }
        return $this->view('registerForm.phtml');
    }

	private function returnRegisterForm($formState){
	  $form = ['action' => '/user/register'];
	  $this->data['form'] = $this->form->buildForm($form, $formState);

      return $this->view('registerForm.phtml');
	}
}