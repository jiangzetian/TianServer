<?php
declare (strict_types = 1);

namespace app\middleware;

use Firebase\JWT\JWT;
use think\facade\Request;


class Auth
{
    public function checkToken()
    {
        $token = Request::header('authorization');
        if(!$token){
            return false;
        }
        $key='TianAdminSalt';
        $status=array("code"=>401);
        try {
            JWT::$leeway = 60;//当前时间减去60，把时间留点余地
            $decoded = JWT::decode($token, $key, array('HS256')); //HS256方式，这里要和签发的时候对应
            $arr = (array)$decoded;
            $res['code']=1;
            $res['data']=$arr;
            return $res;
        } catch(\Firebase\JWT\SignatureInvalidException $e) { //签名不正确
            $status['msg']="签名不正确";
            return $status;
        }catch(\Firebase\JWT\BeforeValidException $e) { // 签名在某个时间点之后才能用
            $status['msg']="token失效";
            return $status;
        }catch(\Firebase\JWT\ExpiredException $e) { // token过期
            $status['msg']="token失效";
            return $status;
        }catch(Exception $e) { //其他错误
            $status['msg']="未知错误";
            return $status;
        }
    }
    public function createToken($id){
        $key = "TianAdminSalt";//这里是自定义的一个随机字串，应该写在config文件中的，解密时也会用，相当于加密中常用的 盐  salt
        $token = [
            "iss"=>"",  //签发者 可以为空
            "aud"=>"", //面象的用户，可以为空
            "iat" => time(), //签发时间
            "nbf" => time(), //在什么时候jwt开始生效
            "exp" => time()+7200, //token 过期时间
            "id" => $id //记录的userid的信息
        ];
        $token = JWT::encode($token,$key,"HS256"); //根据参数生成了 token
        return $token;
    }
}
