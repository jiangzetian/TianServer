<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\api\model\Charts as chartsModel;
use app\api\validate\ChartsValidate;
use app\middleware\Auth;
use api\common;

class Charts extends Auth
{
    //全部查询
    public function index(){
        //权限验证
        $checkArr = $this->checkToken();
        if ($checkArr['code']!==1){return $checkArr;}
        //获取请求数据
        $indexArr = input('get.');
        //验证器
        validate(ChartsValidate::class)->scene('index')->check($indexArr);
        //查询
        $sqlData = chartsModel::where('name',$indexArr['name'])->find();

        return common\success(200,'查询图表数据成功',$sqlData);
    }
    //更新
    public function update(){
        //权限验证
        $checkArr = $this->checkToken();
        if ($checkArr['code']!==1){return $checkArr;}
        //获取请求数据
        $updateArr = input('put.');
        //验证器
        validate(ChartsValidate::class)->scene('update')->check($updateArr);
        //更新
        $sqlData = chartsModel::update([
            'name'=>$updateArr['name'],
            'data'=>$updateArr['data'],
        ],['name'=>$updateArr['name']],['name','data']);

        return common\success(200,'更新图表数据成功',$sqlData);
    }
}
