<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\api\model\Category as catagoryModel;
use api\common;
use app\middleware\Auth;
use app\api\validate\CategoryValidate;

class Category extends Auth
{
    //查询
    public function index(){
        //权限验证
        $checkArr = $this->checkToken();
        //获取请求数据
        $createArr = input('get.');
        //验证器
        validate(CategoryValidate::class)->scene('index')->check($createArr);
        if ($checkArr['code']!==1){return $checkArr;}

        //查询用户
        $sqlData = catagoryModel::where([
            ['name', 'like', '%'.$createArr['name'].'%'],
        ])
            ->order('sort', 'desc')
            ->paginate([
                'list_rows'=> $createArr['pageSize'],
                'page' => $createArr['currentPage'],
            ])
            ->toArray();

        return common\success(200,'查询文章分类成功',$sqlData);
    }
    //新增
    public function create(){
        //权限验证
        $checkArr = $this->checkToken();
        if ($checkArr['code']!==1){return $checkArr;}
        //获取请求数据
        $createArr = input('post.');
        //验证器
        validate(CategoryValidate::class)->scene('create')->check($createArr);
        //新增
        $createArr['id']=uniqid();
        $sqlData = catagoryModel::create($createArr,['id','name','sort']);

        return common\success(200,'添加文章分类成功',$sqlData);
    }
    //删除
    public function delete(){
        //权限验证
        $checkArr = $this->checkToken();
        if ($checkArr['code']!==1){return $checkArr;}
        //获取请求数据
        $deleteArr = input('delete.');
        //验证器
        validate(CategoryValidate::class)->scene('delete')->check($deleteArr);
        //删除
        $sqlData = catagoryModel::where('id','=',$deleteArr['id'])->delete();

        return common\success(200,'删除文章分类'.$deleteArr['name'].'成功',$sqlData);
    }
    //更新
    public function update(){
        //权限验证
        $checkArr = $this->checkToken();
        if ($checkArr['code']!==1){return $checkArr;}
        //获取请求数据
        $updateArr = input('put.');
        //验证器
        validate(CategoryValidate::class)->scene('update')->check($updateArr);
        //更新
        $sqlData = catagoryModel::update([
            'id'=>$updateArr['id'],
            'name'=>$updateArr['name'],
            'sort'=>$updateArr['sort'],
        ],['id'=>$updateArr['id']],['id','name','sort']);

        return common\success(200,'更新文章分类成功',$sqlData);
    }
}
