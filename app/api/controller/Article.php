<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\api\validate\ArticleValidate;
use app\middleware\Auth;
use app\api\model\Article as articleModel;
use api\common;
use think\Request;

class Article extends Auth
{
    //分页查询
    public function page()
    {
        //权限验证
        $checkArr = $this->checkToken();
        if ($checkArr['code']!==1){return $checkArr;}
        //获取请求数据
        $createArr = input('get.');
        //验证器
        validate(ArticleValidate::class)->scene('page')->check($createArr);
        //查询
        $sqlData = articleModel::where([
            ['title', 'like', '%'.$createArr['title'].'%'],
        ])
            ->order('date', 'desc')
            ->paginate([
                'list_rows'=> $createArr['pageSize'],
                'page' => $createArr['currentPage']
            ])
            ->toArray();
        return common\success(200,'查询文章列表成功',$sqlData);
    }
    //新增
    public function create()
    {
        //权限验证
        $checkArr = $this->checkToken();
        if ($checkArr['code']!==1){return $checkArr;}
        //获取请求数据
        $articleArr = input('post.');
        //验证器
        validate(ArticleValidate::class)->scene('create')->check($articleArr);
        //新增
        $articleArr['id']=uniqid('',true);
        $sqlData = articleModel::create($articleArr,['id','title','desc','category','url','date','content','html']);
        //返回
        return common\success(200,'添加文章分类成功',$sqlData);
    }
}
