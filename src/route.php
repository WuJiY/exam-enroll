<?php
/** Kezhi */
namespace Kezhi;
use FastRoute;
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r){
    $r->addRoute('GET', '/', 'User\\index');
    $r->addRoute('GET', '/index.php', 'User\\index');
    $r->addRoute('GET', '/index.php/users', 'User\\get_all_users_handler');
    $r->addRoute('GET', '/index.php/user/{id:\d+}', 'get_users_handler');
    $r->addRoute('GET', '/index.php/import/student_account', 'Import\\student_account');
    $r->addRoute('POST', '/index.php/import/student_account', 'Import\\student_account_handle');

    $r->addRoute('POST', '/api.php/import/student_account', 'api\\Import\\student_account');
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch($routeInfo[0]){
    case FastRoute\Dispatcher::NOT_FOUND:
        // 404
        echo '404';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        var_dump($allowedMethods);
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = explode('\\', $routeInfo[1]);
        $vars = $routeInfo[2];
        if($handler[0] == 'api'){
            $class = __NAMESPACE__ . '\\' . 'Api\\' . $handler[1];
            $args = $handler[2];
        }else{
            $class = __NAMESPACE__ . '\\' . 'Controller\\' . $handler[0];
            $args = $handler[1];
        }
        $controller = new $class();
        call_user_func_array(array($controller, $args), $vars);
        // call $handler with $vars
        break;
}
?>
