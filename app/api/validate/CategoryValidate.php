<?php
declare (strict_types = 1);

namespace app\api\validate;

use think\Validate;

class CategoryValidate extends Validate
{
    protected $rule = [
        'id'  =>  'require|max:25',
        'name'  =>  'require|max:25',
        'sort' => 'require|max:11',
        'pageSize' => 'require',
        'currentPage' => 'require',
    ];
    protected $message = [];
    protected $scene = [
        'index' => [],
        'page' => ['pageSize','currentPage'],
        'create'  =>  ['name','sort'],
        'update'  =>  ['id','name','sort'],
        'delete'  =>  ['id'],
    ];
}
