<?php
define('__VENDOR__', __DIR__ . '/../vendor/');
define('__WEB__', __DIR__ . '/../web/');
define('__CONF__', __DIR__ . '/Config');
define('__TEST__', __DIR__ . '/../tests/');
define('__ROOT__', __DIR__ . '/../');

use Noodlehaus\Config;
error_reporting(0);
$loader = require __VENDOR__ . 'autoload.php';
$loader->add('Kezhi\\Controller\\', __DIR__ . '/Controller');
$conf = new Config(__CONF__);



require 'route.php';

?>
