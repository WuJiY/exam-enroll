<?php
namespace Kezhi\Common;
class Auth {
    protected $rules = [
        'admin' =>  [
            '/\/index.php\/user/',
            '/\/index.php$/'
        ],
        'student'   =>  [
            '/\/index.php\/user/',
            '/\/index.php$/',
            '/\/index.php\/profile/',
            '/\/index.php\/change_password/',
            '/\/index.php\/modify_photo/'
        ],
        'teacher'   =>  [
            '/\/index.php\/user/',
            '/\/index.php$/'
        ],
        'auth'  =>  [
            '/\/index.php\/auth/',
            '/\/api.php\/auth$/'
        ]
    ];

    public function check(){
        $uri = $_SERVER['PHP_SELF'];
        if(isset($_SESSION['role']) === false){
            if($this->match($uri, $this->rules['auth']) === false){
                return false;
            }else{
                return true;
            }
        }else{
            if($this->match($uri, $this->rules[$_SESSION['role']]) === false && $this->match($uri, $this->rules['auth']) === false){
                return false;
            }else{
                return true;
            }
        }
    }

    private function match($uri, $rules){
        foreach($rules as $rule){
            if(preg_match($rule, $uri) == 0){

            }else{
                return true;
            }
        }
        return false;
    }
}
?>
