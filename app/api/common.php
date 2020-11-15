<?php
namespace api\common;

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