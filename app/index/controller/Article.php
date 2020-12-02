<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\index\model\Article as ArticleModel;
use app\middleware\Auth;
use index\common;
class Article extends Auth
{
    public function addVisits(){
        //权限验证
        $checkArr = $this->checkToken();
        if ($checkArr['code']!==1){return $checkArr;}
        //获取请求数据
        $putArr = input('put.');

        $sqlData = ArticleModel::where('id', $putArr['id'])
            ->inc('visits')
            ->update();
        return common\success(200,'文章:'.$putArr['id'].'访问量+1',$sqlData);
    }
    public function addLikes(){
        //权限验证
        $checkArr = $this->checkToken();
        if ($checkArr['code']!==1){return $checkArr;}
        //获取请求数据
        $putArr = input('put.');

        $sqlData = ArticleModel::where('id', $putArr['id'])
            ->inc('likes')
            ->update();
        return common\success(200,'文章:'.$putArr['id'].'点赞+1',$sqlData);
    }
}
