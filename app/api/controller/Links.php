<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\api\model\Links as LinksModel;
use api\common;
use app\middleware\Auth;
use app\api\validate\LinksValidate;
class links extends Auth
{
    //全部查询
    public function index(){
        //权限验证
        $checkArr = $this->checkToken();
        if ($checkArr['code']!==1){return $checkArr;}
        //查询
        $sqlData = LinksModel::select();

        return common\success(200,'查询联系成功',$sqlData);
    }
    //分页查询
    public function page(){
        //权限验证
        $checkArr = $this->checkToken();
        if ($checkArr['code']!==1){return $checkArr;}
        //获取请求数据
        $createArr = input('get.');
        //验证器
        validate(LinksValidate::class)->scene('page')->check($createArr);
        //查询
        $sqlData = LinksModel::where([
            ['name', 'like', '%'.$createArr['name'].'%'],
        ])
            ->order('sort', 'desc')
            ->paginate([
                'list_rows'=> $createArr['pageSize'],
                'page' => $createArr['currentPage'],
            ])
            ->toArray();
        return common\success(200,'查询联系成功',$sqlData);
    }
    //新增
    public function create(){
        //权限验证
        $checkArr = $this->checkToken();
        if ($checkArr['code']!==1){return $checkArr;}
        //获取请求数据
        $createArr = input('post.');
        //验证器
        validate(LinksValidate::class)->scene('create')->check($createArr);
        //新增
        $createArr['id']=uniqid();
        $sqlData = LinksModel::create($createArr,['id','name','desc','url','img','color','sort']);

        return common\success(200,'添加联系成功',$sqlData);
    }
    //删除
    public function delete(){
        //权限验证
        $checkArr = $this->checkToken();
        if ($checkArr['code']!==1){return $checkArr;}
        //获取请求数据
        $deleteArr = input('delete.');
        //验证器
        validate(LinksValidate::class)->scene('delete')->check($deleteArr);
        //删除
        $sqlData = LinksModel::where('id','=',$deleteArr['id'])->delete();

        return common\success(200,'删除联系'.$deleteArr['name'].'成功',$sqlData);
    }
    //更新
    public function update(){
        //权限验证
        $checkArr = $this->checkToken();
        if ($checkArr['code']!==1){return $checkArr;}
        //获取请求数据
        $updateArr = input('put.');
        //验证器
        validate(LinksValidate::class)->scene('update')->check($updateArr);
        //更新
        $sqlData = LinksModel::update([
            'id'=>$updateArr['id'],
            'name'=>$updateArr['name'],
            'desc'=>$updateArr['desc'],
            'url'=>$updateArr['url'],
            'img'=>$updateArr['img'],
            'color'=>$updateArr['color'],
            'sort'=>$updateArr['sort'],
        ],['id'=>$updateArr['id']],['id','name','desc','url','img','color','sort']);

        return common\success(200,'更新联系成功',$sqlData);
    }
}
