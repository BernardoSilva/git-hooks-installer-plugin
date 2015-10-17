<?php

error_reporting(E_ALL);

$loader = require __DIR__.'/../vendor/autoload.php';
$loader->add('Composer\Test', __DIR__.'/../vendor/composer/composer/tests');
$loader->add('phpDocumentor', __DIR__.'/unit');