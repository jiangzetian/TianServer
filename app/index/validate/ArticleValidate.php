<?php
declare (strict_types = 1);

namespace app\index\validate;

use think\Validate;

class ArticleValidate extends Validate
{
    protected $rule = [
        'id'  =>  'require',
        'title'  =>  'require',
        'desc' => 'require',
        'category' => 'require',
        'url' => 'require|url',
        'date' => 'require|date',
        'content' => 'require',
        'html' => 'require',
        'visits' => 'require|number',
        'likes' => 'require|number',
    ];
    protected $message = [];
    protected $scene = [
        'page'    =>  ['pageSize','currentPage'],
        'detail'  =>  ['id'],
        'addVisits'  =>  ['id'],
        'addLikes'   =>  ['id'],
    ];
}

