<?php
/** 公共 类库 */
namespace Kezhi\Common;
/**
 * 权限认证类
*/
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

    /**
     * 检查当前访问权限
     * 根据$_SERVER['PHP_SELF'] 和 $_SESSION['role']进行判断是否拥有访问权限
     * @return bool 拥有访问权限返回true，没有返回false
    */
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

    /**
     * 匹配uri与规则
     * 遍历规则$rules ,匹配rui
     * @param string $uri 要匹配的uri
     * @param Array  $rules 规则集
     * @return bool 成功匹配到返回true，否则返回false
    */
    private function match($uri, Array $rules){
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
