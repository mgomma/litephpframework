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

	}

	public function index(){
	  if($this->request->isPost()){

	  	$this->registerFormSubmit();
	  }else{

	  	$this->returnRegisterForm([]);
	  }
	}

	private function registerFormSubmit(){
	  $post = $this->request->post();
	  $this->model->validate($post);

	  $state = $this->model->getModelState();
	  if($this->model->hasErrors()){
	  	$formState = [];

	  	foreach ($post as $key => $value) {
	  	  $formState[$key]['value'] = $value;

	  	  if(isset($state[$key])){
	  	    $formState[$key]['errors'] = $state[$key];
	  	  }
	  	}

	  	$this->returnRegisterForm($formState);
	  }
	}

	private function returnRegisterForm($formState){
	  $form = ['action' => '/user/register'];

	  $data = $this->form->buildForm($form, $formState);

	  return $this->view('registerForm.phtml', $data);
	}
}