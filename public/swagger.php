<?php
require_once(realpath('../vendor/autoload.php'));
$swagger = \Swagger\scan('../app');
header('Content-Type: application/json');
echo $swagger;