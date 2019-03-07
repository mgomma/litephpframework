<?php

namespace App\core\test;

interface TestBaseInterface{

  public function assert($field, $value);

  public function runTest();
};