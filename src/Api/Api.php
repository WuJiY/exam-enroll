<?php
namespace Kezhi\Api;
class Api {
    const OK = 200; // GET 服务器成功返回用户请求的数据
    const CREATED = 201;    // POST/PUT/PATCH 用户新建或修改数据成功
    const ACCEPTED = 202;   // * 表示一个请求已经进入后台排队
    const NO_CONTENT = 204; // DELETE 用户删除数据成功
    const INVALID_REQUEST = 400;    // POST/PUT/PATCH 用户发出的请求有错误，服务器没有进行新建或修改数据的操作
    const UNAUTHORIZED = 401;   // * 表示用户没有权限（令牌、用户名、密码错误）
    const FORBIDDEN = 403;  // * 表示用户得到授权，但是访问是被禁止的
    const NOT_FOUND = 404;  // * 用户发出的请求针对的是不存在的记录，服务器没有进行操作
    const NOT_ACCEPTABLE = 406; // GET 用户请求的格式不可得（比如用户请求JSON格式，但是只有XML格式）
    const GONE = 410;   // GET 用户请求的资源被永久删除，且不会再得到的。
    const UNPROCESABLE_ENTITY = 422;    // POST/PUT/PATCH 当创建一个对象时，发生一个验证错误
    const INTERNAL_SERVER_ERROR = 500;  // * 服务器发生错误，用户将无法判断发出的请求是否成功。

    protected $result = array();

    public function sendJson(){
        echo json_encode($this->result);
    }
}
?>
