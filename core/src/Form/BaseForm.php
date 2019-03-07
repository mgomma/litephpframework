<?php

namespace App\core\Form;

class BaseForm implements FormInterface{

	private $values;

	protected $errors;

	public function buildForm(&$form, &$formState){
	  $form['action'] = BASE_URL.$form['action'];

	  $_SESSION['form_token'] = \md5(time());
	  $form['elements']['form_token'] = ['type' => 'hidden', 'value' =>  $_SESSION['form_token']];

	  foreach ($formState as $key => $value) {
	  	if(isset($formState[$key]['value'])){

	  	  $form['elements'][$key]['value'] = $formState[$key]['value'];
	  	}

	    if(isset($formState[$key]['errors'])){
	  	  $form['elements'][$key]['errors'] = $formState[$key]['errors'];
	  	}
	  }
	}
}
