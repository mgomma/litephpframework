<?php 
namespace App\user\Form;

use App\core\Form\BaseForm;

class RegisterForm extends BaseForm{

	public function __Construct(){

	}

	public function buildForm(&$form, &$formState){

	  $form = [
	  	'action' => $form['action'],
	  	'method' => 'post',
	  	'elements' => [  
	  	  'first_name' => [
	  	  	'type' => 'text',
	  	    'label' => 'First name',
  	    	'description' => '', 
	  	    'attributes' => [
	  	    	'required' => 'requried',
	  	    	'min' => '2', 
	  	    	'max' => '20',
	  	    ],
	  	  ],
	  	  'last_name' => [
	  	  	'type' => 'text',
	  	  	 'label' => 'Last name',
	  	  	 'description' => '',
	  	  	 'attributes' => [
	  	  	 	'required' => 'requried',
	  	  	   	'min' => '2',
	  	  	   	'max' => '20',
	  	  	]
	  	  ],
	  	  'email' => [
	  	  	'type' => 'email', 
	  	  	'label' => 'Email',
	  	  	'description' => '',
	  	  	'attributes' => [
	  	  		'required' => 'requried',
	  	  		'min' => '7',
	  	  		'max' => '20',
	  	  	]
	  	  ],
	  	  'phone_number' => [
	  	  	'type' => 'phome',
	  	  	 'label' => 'Phone number',
	  	  	 'description' => '',
	  	  	 'attributes' => [
	  	  	   	'required' => 'requried',
	  	  	   	'min' => '12',
	  	  	   	'max' => '12',
	  	  	  ]
	  	  	],
	    ],
	  ];

	  parent::buildForm($form, $formState);
	  return $form;
	}
}