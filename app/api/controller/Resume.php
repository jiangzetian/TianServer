<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\api\model\Resume as resumeModel;
use app\api\validate\ResumeValidate;
use app\middleware\Auth;
use api\common;
class Resume extends Auth
{
    //查询
    public function index()
    {
        //权限验证
        $checkArr = $this->checkToken();
        if ($checkArr['code']!==1){return $checkArr;}
        //获取请求数据
        $indexArr = input('get.');
        //验证器
        validate(ResumeValidate::class)->scene('index')->check($indexArr);
        //查询
        $sqlData = resumeModel::where('id',$indexArr['id'])->find();
        return common\success(200,'查询简历数据成功', $sqlData);
    }
    //更新
    public function update(){
        //权限验证
        $checkArr = $this->checkToken();
        if ($checkArr['code']!==1){return $checkArr;}
        //获取请求数据
        $updateArr = input('put.');
        //验证器
        validate(ResumeValidate::class)->scene('update')->check($updateArr);
        //更新
        $sqlData = resumeModel::update([
            'id'=>$updateArr['id'],
            'content'=>$updateArr['content'],
        ],['id'=>$updateArr['id']],['id','content']);

        return common\success(200,'更新简历成功',$sqlData);
    }
    //创建
    public function create()
    {
        //权限验证
        $checkArr = $this->checkToken();
        if ($checkArr['code']!==1){return $checkArr;}
        //获取请求数据
        $createArr = input('post.');
        //验证器
        validate(ResumeValidate::class)->scene('create')->check($createArr);
        //新增
        $createArr['id']=uniqid();
        $sqlData = resumeModel::create($createArr,['id','content']);
        //返回
        return common\success(200,'添加简历成功',$sqlData);
    }
}