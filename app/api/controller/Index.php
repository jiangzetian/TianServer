<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\api\model\Watch;
use app\api\model\Article;
use app\api\model\Category;
use api\common;
class Index
{
    public function index()
    {
        $data['title'] = '这是首页';
        return json($data);
    }
    public function watch(){
        //获取总点赞数
        $all_likes = array_sum(Article::column('likes'));
        //获取总文章数
        $all_article = Article::count();
        //获取总分类数
        $all_category = Category::count();

        //更新到watch表格 并查询
        $sqlData =  Watch::update([
            'id'=>1,
            'all_article' => $all_article,
            'all_category'=>$all_category,
            'all_likes' => $all_likes
        ])
        ->select();

        return common\success(200,'查询统计数据成功！',$sqlData);
    }
}
