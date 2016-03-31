<?php
/** API */
namespace Kezhi\Api;
/**
 * API 基类
 *
*/
class Api {
    /** @var Integer OK GET 服务器成功返回用户请求的数据 */
    const OK = 200;
    /** @var Integer CREATED POST/PUT/PATCH 用户新建或修改数据成功 */
    const CREATED = 201;
    /** @var Integer ACCEPTED * 表示一个请求已经进入后台排队 */
    const ACCEPTED = 202;
    /** @var Integer NO_CONTENT DELETE 用户删除数据成功 */
    const NO_CONTENT = 204;
    /** @var Integer INVALID_REQUEST POST/PUT/PATCH 用户发出的请求有错误，服务器没有进行新建或修改数据的操作*/
    const INVALID_REQUEST = 400;
    /** @var Integer UNAUTHORIZED * 表示用户没有权限（令牌、用户名、密码错误） */
    const UNAUTHORIZED = 401;
    /** @var Integer FORBIDDEN * 表示用户得到授权，但是访问是被禁止的 */
    const FORBIDDEN = 403;
    /** @var Integer NOT_FOUND * 用户发出的请求针对的是不存在的记录，服务器没有进行操作 */
    const NOT_FOUND = 404;
    /** @var Integer NOT_ACCEPTABLE GET 用户请求的格式不可得（比如用户请求JSON格式，但是只有XML格式） */
    const NOT_ACCEPTABLE = 406;
    /** @var Integer GONE GET 用户请求的资源被永久删除，且不会再得到的。 */
    const GONE = 410;
    /** @var Integer UNPROCESABLE_ENTITY POST/PUT/PATCH 当创建一个对象时，发生一个验证错误 */
    const UNPROCESABLE_ENTITY = 422;
    /** @var Integer INTERNAL_SERVER_ERROR * 服务器发生错误，用户将无法判断发出的请求是否成功。 */
    const INTERNAL_SERVER_ERROR = 500;

    /** @var Array $result 将要返回给客户端的结果 */
    protected $result = array();

    /**
     * API构造函数
     * 打开输出缓冲控制，禁止API随意输出数据，只能返回json格式的数据
    */
    public function __construct(){
        ob_start();
    }

    /**
     * 无效参数请求处理方法
     * 
    */
    protected function invalid_request(){
        $this->result['status'] = self::INVALID_REQUEST;
        $this->result['data'] = '无效的参数';
        $this->sendJson();
    }

    /**
     * 发送json数据
    */
    public function sendJson(){
        ob_end_clean();
        //ob_end_flush();
        header('Content-type: text/json');
        echo json_encode($this->result);
        exit;
    }
}
?>
