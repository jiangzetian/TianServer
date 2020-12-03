<?php
declare (strict_types = 1);

namespace app\index\controller;

use index\common;
use app\index\model\Watch as WatchModel;
class Index
{
    public function index()
    {
        return '您好！这是一个[index]示例应用';
    }
    //总访问量
    public function addAllVisits(){
        $sqlData = WatchModel::where('id', 1)
            ->inc('all_visits')
            ->update();
        return common\success(200,'访问量+1',$sqlData);
    }
}
