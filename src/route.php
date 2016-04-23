<?php
/** Kezhi */
namespace Kezhi;
use FastRoute;
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r){
    $r->addRoute('GET', '/', 'User\\index');
    $r->addRoute('GET', '/index.php', 'User\\index');
    $r->addRoute('GET', '/index.php/auth', 'Auth\\signIn');
    $r->addRoute('GET', '/index.php/auth/out', 'Auth\\signOut');
    $r->addRoute('GET', '/index.php/users', 'User\\get_all_users_handler');
    $r->addRoute('GET', '/index.php/user/{id:\d+}', 'User\\index');
    $r->addRoute('GET', '/index.php/user', 'User\\index');
    $r->addRoute('GET', '/index.php/import/student_account', 'Import\\student_account');
    $r->addRoute('GET', '/index.php/import/pay_info', 'Import\\pay_info');
    $r->addRoute('GET', '/index.php/import/photos', 'Import\\photos');
    $r->addRoute('GET', '/index.php/import/score', 'Import\\score');
    $r->addRoute('GET', '/index.php/profile', 'User\\profile');
    $r->addRoute('GET', '/index.php/modify_photo', 'User\\modify_photo');
    $r->addRoute('GET', '/index.php/change_password', 'User\\change_password');
    $r->addRoute('GET', '/index.php/enroll_info', 'Enroll\\index');
    $r->addRoute('GET', '/index.php/enroll', 'Enroll\\enroll');
    $r->addRoute('GET', '/index.php/score', 'Score\\index');
    $r->addRoute('GET', '/index.php/exam', 'Exam\\index');
    $r->addRoute('GET', '/index.php/exam/add', 'Exam\\add');
    $r->addRoute('GET', '/index.php/exam/edit/{id:\d+}', 'Exam\\edit');
    $r->addRoute('GET', '/index.php/diploma', 'Diploma\\index');
    $r->addRoute('GET', '/index.php/room', 'Room\\index');
    $r->addRoute('GET', '/index.php/room/add', 'Room\\add');
    $r->addRoute('GET', '/index.php/room/edit/{id:\d+}', 'Room\\edit');
    $r->addRoute('GET', '/index.php/room/allot', 'Room\\allot');
    $r->addRoute('GET', '/index.php/building', 'Room\\building');
    $r->addRoute('GET', '/index.php/building/add', 'Room\\building_add');
    $r->addRoute('GET', '/index.php/building/edit/{id:\d+}', 'Room\\building_edit');
    $r->addRoute('GET', '/index.php/student_info', 'Student\\student_info');
    $r->addRoute('GET', '/index.php/student/edit/student_info/{id:\d+}', 'Student\\edit_student_info');
    $r->addRoute('GET', '/index.php/pay_info', 'Student\\pay_info');
    $r->addRoute('GET', '/index.php/photos', 'Student\\photos');

    $r->addRoute('GET', '/index.php/test/{id:\d+}', 'Import\\test');

    $r->addRoute('POST', '/api.php/import/student_account', 'api\\Import\\student_account');
    $r->addRoute('POST', '/api.php/auth', 'api\\Auth\\auth');
    $r->addRoute('POST', '/api.php/user/add', 'api\\User\\add');
    $r->addRoute('POST', '/api.php/user/delete', 'api\\User\\delete');
    $r->addRoute('POST', '/api.php/user/update', 'api\\User\\update');
    $r->addRoute('POST', '/api.php/user/change_password', 'api\\User\\change_password');
    $r->addRoute('POST', '/api.php/student/info', 'api\\Student\\get_info');
    $r->addRoute('GET', '/api.php/student/info/{id:\d+}', 'api\\Student\\get_info');
    $r->addRoute('POST', '/api.php/student/delete', 'api\\Student\\del');
    $r->addRoute('POST', '/api.php/exam/add', 'api\\Exam\\add');
    $r->addRoute('POST', '/api.php/exam/info', 'api\\Exam\\info');
    $r->addRoute('POST', '/api.php/exam/edit', 'api\\Exam\\edit');
    $r->addRoute('POST', '/api.php/exam/delete', 'api\\Exam\\del');
    $r->addRoute('POST', '/api.php/building/add', 'api\\Room\\building_add');
    $r->addRoute('POST', '/api.php/building/delete', 'api\\Room\\building_delete');
    $r->addRoute('POST', '/api.php/building/edit', 'api\\Room\\building_edit');
    $r->addRoute('POST', '/api.php/room/add', 'api\\Room\\add');
    $r->addRoute('POST', '/api.php/room/delete', 'api\\Room\\delete');
    $r->addRoute('POST', '/api.php/room/edit', 'api\\Room\\edit');
    $r->addRoute('POST', '/api.php/exam/enroll/state', 'api\\Exam\\set_enroll_state');
    $r->addRoute('POST', '/api.php/exam/score/state', 'api\\Exam\\set_score_state');


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
