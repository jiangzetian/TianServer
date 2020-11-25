<?php
// 这是系统自动生成的公共文件
namespace index\common;

function success($code=200, $msg='成功', $data=[])
{
    return json(
        [
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data
        ]
    );
}