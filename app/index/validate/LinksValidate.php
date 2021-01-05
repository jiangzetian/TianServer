<?php
declare (strict_types = 1);

namespace app\index\validate;

use think\Validate;

class LinksValidate extends Validate
{
    protected $rule = [
        'id'  =>  'require|max:25',
        'name'  =>  'require|max:25',
        'url'  =>  'require',
        'img'  =>  'require',
        'color'  =>  'require',
        'sort' => 'require|max:11',
        'pageSize' => 'require',
        'currentPage' => 'require',
    ];
    protected $message = [];
    protected $scene = [
        'index' => [],
    ];
}