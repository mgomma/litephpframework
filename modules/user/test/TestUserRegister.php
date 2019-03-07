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

  	echo 'Start test user register <br/><br/>';

  	foreach ($fields as $field) {
  	  $otherCases = $this->testCasesArr;

  	  unset($otherCases[$field]);
  	  $arr = [];

  	  foreach($this->testCasesArr[$field]['success'] as $v){
  	  	$arr[$field] = $v;

  	  	foreach ($otherCases as $kk => $vv) {
  	  	  $arr[$kk] = reset($vv['success']);
  	  	}

  	    $res = $this->model->validate($arr);
        $this->assert($field, $v);
  	  }

  	  foreach($this->testCasesArr[$field]['fail'] as $v){
  	  	$arr[$field] = $v;

  	  	foreach ($otherCases as $kk => $vv) {
  	  	  $arr[$kk] = reset($vv['success']);
  	  	}
  	    $res = $this->model->validate($arr);
  	    $this->assert($field, $v);
  	  }
  	}
  }

  public function assert($field, $value){
  	if($this->model->hasErrors()){
  	  echo 'test: <b>'.$field.'</b>, against: <b>'.$value.'</b> failed <br/>';

  	  ;
  	  foreach (array_filter($this->model->getModelState()) as $key => $value) {
  	  	foreach ($value as $k => $v) {

  	  	  echo $v.'<br/>';
  	  	}
  	  }
  	}else{

  	  echo 'test: <b>'.$field.'</b>, against: <b>'.$value.'</b> success <br/> <br/>';
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