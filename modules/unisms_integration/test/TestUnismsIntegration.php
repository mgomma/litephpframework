<?php

namespace App\unisms_integration\test;

use App\core\test\TestBase;
use App\unisms_integration\Model\UnismsModel;

class TestUnismsIntegration extends TestBase{

    private $model;

  function __Construct(){
      $this->model = new UnismsModel();
  }

  public function runTest(){

    echo '<p style="color:blue"> Start test user register </p>';
    $this->testConfig();

    $this->testUnismsIntegration();
  }


  public function testUnismsIntegration(){
      $result = $this->model->sendCode(['Recipient' => 'XXXXXX', 'code' => '1234']);

      $resultObj = json_decode($result);

      if(isset($resultObj->success)){
          echo '<p style="color:green"> test Unisms integration connection passed </p>';
      }else{
          echo '<p style="color:red"> test Unisms integration connection failed </p>';
      }

  }

  public function testConfig(){
      $uniSmsEnv = $GLOBALS['env']['unisms'];
      if(isset($uniSmsEnv['AppSid']) && isset($uniSmsEnv['url'])){
          echo '<p style="color:green"> Uni sms integration data passed test </p>';
      }else{
          echo '<p style="color:red"> Uni sms integration data not exist failed  </p>';
      }
  }

  public function assert($field, $value){

  }
}