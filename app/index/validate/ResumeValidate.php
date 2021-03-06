<?php
declare (strict_types = 1);

namespace app\index\validate;

use think\Validate;

class ResumeValidate extends Validate
{
    protected $rule = [
        'id'  => 'require',
        'content'  => 'require',
    ];
    protected $message = [];
    protected $scene = [];
}