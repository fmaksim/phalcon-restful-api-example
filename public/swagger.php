<?php

error_reporting(0);
ini_set('display_errors', 0);

require_once(realpath('../vendor/autoload.php'));
$swagger = \Swagger\scan('../app');
echo $swagger;