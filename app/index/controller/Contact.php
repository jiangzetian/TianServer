<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\index\model\Contact as ContactModel;
use index\common;
use app\middleware\Auth;
use app\index\validate\ContactValidate;
class Contact extends Auth
{
    //全部查询
    public function index(){
        //查询
        $sqlData = ContactModel::select();
        return common\success(200,'查询联系成功',$sqlData);
    }
}
