<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\index\validate\ArticleValidate;
use app\index\model\Article as ArticleModel;
use app\middleware\Auth;
use index\common;
class Article extends Auth
{
    //获取文章列表
    public function page()
    {
        //获取请求数据
        $getArr = input('get.');
        //验证器
        validate(ArticleValidate::class)->scene('page')->check($getArr);
        //查询
        if(!empty($getArr['category'])){
            $pageModel = articleModel::where('category','=',$getArr['category'])->order('date', 'desc')->withoutField('content,html');
        }else{
            $pageModel = articleModel::order('date', 'desc')->withoutField('content,html');
        }
        $sqlData = $pageModel
            ->paginate([
                'list_rows'=> $getArr['pageSize'],
                'page' => $getArr['currentPage']
            ])
            ->toArray();
        return common\success(200,'查询文章列表成功',$sqlData);
    }
    //获取详情
    public function detail(){
        //获取请求数据
        $deleteArr = input('get.');
        //验证器
        validate(ArticleValidate::class)->scene('detail')->check($deleteArr);
        //删除
        $sqlData = articleModel::where('id','=',$deleteArr['id'])->find();
        //返回
        return common\success(200,'查询文章详情成功'.$deleteArr['id'].'成功',$sqlData);
    }
    //文章访客
    public function addVisits(){
        //获取请求数据
        $putArr = input('put.');

        $sqlData = ArticleModel::where('id', $putArr['id'])
            ->inc('visits')
            ->update();
        return common\success(200,'文章:'.$putArr['id'].'访问量+1',$sqlData);
    }
    //文章点赞
    public function addLikes(){
        //获取请求数据
        $putArr = input('put.');

        $sqlData = ArticleModel::where('id', $putArr['id'])
            ->inc('likes')
            ->update();
        return common\success(200,'文章:'.$putArr['id'].'点赞+1',$sqlData);
    }
}
