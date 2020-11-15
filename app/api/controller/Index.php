<?php
declare (strict_types = 1);

namespace app\api\controller;

use think\facade\Request;
class Index
{
    public function index()
    {
        $data['title'] = '这是首页';
        return json($data);
    }
}
