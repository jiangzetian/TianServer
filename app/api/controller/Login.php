<?php
declare (strict_types = 1);

namespace app\api\controller;

use api\common;
use app\middleware\Auth;
use app\api\validate\LoginValidate;
use app\api\model\AdminUser;

class Login extends Auth
{
    public function signUp()
    {
        //获取请求数据
        $loginArr = input('post.');
        //验证器
        validate(LoginValidate::class)->scene('signUp')->check($loginArr);
        //查询用户
        $sqlData = AdminUser::where([
                ['tel',"=",$loginArr['tel']],
                ['pwd',"=",$loginArr['pwd']]
            ])
            ->find();
        //是否登录成功
        if($sqlData){
            $token = $this->createToken($sqlData['id']);
            AdminUser::where("id",$sqlData['id'])
                ->data(["token"=>$token])
                ->save();
            $sqlData = AdminUser::where("id",$sqlData['id'])
                ->find();
            return common\success(200,'登录成功',$sqlData);
        }else{
            return common\success(401,'登录失败',null);
        }
    }
    public function signOut()
    {
        //Token验证
        $checkArr = $this->checkToken();
        if ($checkArr['code']!==1){return $checkArr;}
        //清空登录状态
        AdminUser::where([
                ["id", "=", $checkArr['data']['id']],
            ])
            ->data(["token" => null])
            ->save();
        return common\success(200, '退出登录成功', null);
    }
    public function signStatus(){
        //Token验证
        $checkArr = $this->checkToken();
        if ($checkArr['code']!==1){return $checkArr;}
        return common\success(200, '已登录', null);
    }
}
