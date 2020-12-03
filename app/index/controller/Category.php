<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\index\model\Category as catagoryModel;
use index\common;
class Category
{
    //全部查询
    public function index(){
        //查询
        $sqlData = catagoryModel::column('*','id');
        return common\success(200,'查询文章分类成功',$sqlData);
    }
}
