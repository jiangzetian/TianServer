<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\index\model\Resume as resumeModel;
use index\common;

class Resume
{
    //查询
    public function index()
    {
        //查询
        $sqlData = resumeModel::where('id','601a41b9eb10d')->find();
        return common\success(200,'查询简历数据成功', $sqlData);
    }
}
