<?php
declare (strict_types = 1);

namespace app\api\validate;

use think\Validate;

class LoginValidate extends Validate
{
    protected $rule = [
        'tel'  =>  'require|max:25',
        'pwd'  =>   'require|max:25',
        'id'   =>   'require|max:25',
    ];
    protected $message = [];
    protected $scene = [
        'signUp'  =>  ['tel','pwd'],
        'signOut' =>  ['id'],
    ];
}
