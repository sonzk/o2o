<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/18
 * Time: 下午2:17
 */

namespace app\api\controller;


use think\Controller;

class Category extends Controller
{
    protected $obj;

    public function _initialize()
    {
        $this->obj = \model('Category');
    }

    public function getCategoryByParentId(){
        $id = input('post.id',0,'intval');
        if (!$id){
            $this->error('参数不合法');
        }
        $categorys = $this->obj->getCategoryByParentId($id);

        if (!$categorys){
            return show(0,'empyt');
        }
        return show(1,'success',$categorys);
    }
}