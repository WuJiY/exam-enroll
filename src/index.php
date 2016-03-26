<?php
/**
 * 入口文件
 * 
*/

/** @var String __VENDOR__ composer库目录 */
define('__VENDOR__', __DIR__ . '/../vendor/');
/** @var String __WEB__ WEB根目录 */
define('__WEB__', __DIR__ . '/../web/');
/** @var String __CONF__ 配置目录 */
define('__CONF__', __DIR__ . '/Config');
/** @var String __TEST__ 单元测试目录*/
define('__TEST__', __DIR__ . '/../tests/');
/** @var String __ROOT__ 项目根目录 */
define('__ROOT__', __DIR__ . '/../');

use Noodlehaus\Config;
error_reporting(0);
$loader = require __VENDOR__ . 'autoload.php';
$loader->add('Kezhi\\Controller\\', __DIR__ . '/Controller');
$conf = new Config(__CONF__);



require 'route.php';

?>
