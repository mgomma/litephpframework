<?php

namespace App\user\test;

use App\core\test\TestBase;
use App\user\Model\UserRegisterModel;

class TestUserRegister extends TestBase{

  public $testCases;

  function __Construct(){
  	$this->model = new UserRegisterModel();

  	$this->testCasesArr = [];
  	$this->buildTestCasesArr();
  }

  public function runTest(){
  	$fields = $this->model->getFields();

  	echo '<p style="color:blue"> Start test user register </p>';

  	foreach ($fields as $field) {
      $otherCases = $this->testCasesArr;

      unset($otherCases[$field]);
      $arr = [];

        if (isset($this->testCasesArr[$field])) {

            foreach ($this->testCasesArr[$field]['success'] as $v) {
                $arr[$field] = $v;

                foreach ($otherCases as $kk => $vv) {
                    $arr[$kk] = reset($vv['success']);
                }

                $res = $this->model->validate($arr);
                $this->assert($field, $v);
            }

            foreach ($this->testCasesArr[$field]['fail'] as $v) {
                $arr[$field] = $v;

                foreach ($otherCases as $kk => $vv) {
                    $arr[$kk] = reset($vv['success']);
                }
                $res = $this->model->validate($arr);
                $this->assert($field, $v);
            }
        }
      }

  	$this->testCodeLength();
  }

  public function  testCodeLength(){
      $mobile = '12345678';
      $this->model->GenerateSmsCode($mobile);

      echo '<p style="color:blue"> Start testing generate sms code </p>';

      if(isset($_SESSION['uniSmsCode']) && strlen($_SESSION['uniSmsCode']) == 4){
          echo '<p style="color:green"> sms code length 4 digits passed </p>';
      }else{
          echo '<p style="color:red"> sms code length failed </p>';
      }

      if(isset($_SESSION['uniSmsSendTime'])){
          echo '<p style="color:green"> uniSmsSendTime test passed </p>';
      }else{
          echo '<p style="color:red"> uniSmsSendTime test failed </p>';
      }


      if(isset($_SESSION['uniSmsSendCounter'])){
          echo '<p style="color:green">uniSmsSendCounter test passed </p>';
      }else{
          echo '<p style="color:red"> uniSmsSendCounter test failed </p>';
      }
  }


  public function assert($field, $value){
  	if($this->model->hasErrors()){
  	  echo '<p style="color:red">test: <b>'.$field.'</b>, against: <b>'.$value.'</b> failed </p>';

  	  ;
  	  foreach (array_filter($this->model->getModelState()) as $key => $value) {
  	  	foreach ($value as $k => $v) {

  	  	  echo $v.'<br/>';
  	  	}
  	  }
  	}else{

  	  echo '<p style="color:green">test: '.$field.'</b>, against: <b>'.$value.'</b> passed </p> <br/>';
  	}
  	echo '<br/>';
  }

  public function buildTestCasesArr(){
  	$this->testCasesArr = [
  	  'first_name' =>
  	  [
  	    'success' => ['ahmed', 'ah', 'asdfghjklpzxcvbnmklo'],
  	    'fail' => ['asdfghjklpzxcvbnmklot', 'a', 'f23', '@#fg', '123']
      ],
      'last_name' =>
  	  [
  	    'success' => ['ahmed', 'ah', 'asdfghjklpzxcvbnmklo'],
  	    'fail' => ['asdfghjklpzxcvbnmklot', 'a', 'f23', '@#fg', '123']
      ],
      'email' => 
  	  [
  	    'success' => ['foo@example.com', 'Foo.noo@example.com', 'foo_noo@example.com'],
  	    'fail' => ['Foo@Example.com', 'foo~noo@example.com', 'oo@example.net']
  	  ],
  	  'phone_number' =>
  	  [
  	    'success' => ['962712345678'],
  	    'fail' => ['12345678', '961212345678'],
   	  ]
   	];
  }
}