<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\index\model\Charts as chartsModel;
use app\index\validate\ChartsValidate;
use app\middleware\Auth;
use index\common;

class Charts extends Auth
{
    //全部查询
    public function index(){
        //获取请求数据
        $indexArr = input('get.');
        //验证器
        validate(ChartsValidate::class)->scene('index')->check($indexArr);
        //查询
        $sqlData = chartsModel::where('name',$indexArr['name'])->find();
        $sqlData = json_decode($sqlData['data']);

        return common\success(200,'查询图表数据成功',$sqlData);
    }
}
