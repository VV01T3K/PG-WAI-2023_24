<?php

require '../../vendor/autoload.php';
use core\qux;

$test = new test();

$test->hello();
$test->hello();
$test->hello();

$foo = new Foo();

$foo->rujka();

$rus = new qux();

$rus->hello();

$rus = new core\lux();

$rus->hello();