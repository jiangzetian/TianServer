<?php
declare (strict_types = 1);

namespace app\api\validate;

use think\Validate;

class ContactValidate extends Validate
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
        'page' => ['pageSize','currentPage'],
        'create'  =>  ['name','url','img','color','sort'],
        'update'  =>  ['id','name','sort'],
        'delete'  =>  ['id'],
    ];
}
