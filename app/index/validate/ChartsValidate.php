<?php
declare (strict_types = 1);

namespace app\index\validate;

use think\Validate;

class ChartsValidate extends Validate
{
    protected $rule = [
        'name'  =>  'require|max:25',
        'data' => 'require',
    ];
    protected $message = [];
    protected $scene = [
        'index' => ['name'],
        'update' => ['name','data']
    ];
}
