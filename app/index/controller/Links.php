<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\index\model\Links as LinksModel;
use index\common;
use app\middleware\Auth;
use app\index\validate\LinksValidate;
class Links extends Auth
{
    //全部查询
    public function index(){
        //查询
        $sqlData = LinksModel::order('sort', 'desc')
            ->select();
        return common\success(200,'查询友链成功',$sqlData);
    }
}