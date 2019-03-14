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
	  	    'label' => 'First Name',
  	    	'description' => '', 
	  	    'attributes' => [
	  	    	'required' => 'requried',
	  	    	'min' => '2', 
	  	    	'max' => '20',
	  	    ],
	  	  ],
	  	  'last_name' => [
	  	  	'type' => 'text',
	  	  	 'label' => 'Last Name',
	  	  	 'description' => '',
	  	  	 'attributes' => [
	  	  	 	'required' => 'requried',
	  	  	   	'min' => '2',
	  	  	   	'max' => '20',
	  	  	]
	  	  ],
	  	  'email' => [
	  	  	'type' => 'email', 
	  	  	'label' => 'Email Name',
	  	  	'description' => '',
	  	  	'attributes' => [
	  	  		'required' => 'requried',
	  	  		'min' => '7',
	  	  		'max' => '20',
	  	  	]
	  	  ],
	  	  'phone_number' => [
	  	  	'type' => 'phone',
	  	  	 'label' => 'Phone Number',
	  	  	 'description' => '',
	  	  	 'attributes' => [
	  	  	   	'required' => 'requried',
	  	  	   	'min' => '12',
	  	  	   	'max' => '12',
	  	  	  ]
	  	  	],
          'sms_button' => [
                'type' => 'button',
                'value' => 'Send SMS to verify',
                'attributes' => [
                  'style' => 'display: none;',
                ],
            ],
          'sms_code' => [
                'type' => 'text',
                'label' => 'Verification Code',
                'description' => '',
                'attributes' => [
                    'style' => 'display: none;',
                    'min' => '4',
                    'max' => '4',
                ]
            ],
	    ],
	  ];

	  parent::buildForm($form, $formState);
	  return $form;
	}
}