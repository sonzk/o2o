<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/18
 * Time: 下午1:28
 */

namespace app\api\controller;


use think\Controller;

class City extends Controller
{
    protected $obj;

    public function _initialize()
    {
        $this->obj = \model('City');
    }

    public function getCityByParentId(){
        $id = input('post.id',0,'intval');
        if (!$id){
            return show(0,'empyt');
        }

        $citys = $this->obj->getCityByParentId($id);

        if (!$citys){
            return show(0,'empyt');
        }
        return show(1,'success',$citys);
    }
}