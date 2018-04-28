<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/17
 * Time: 下午1:53
 */

namespace app\common\model;


use think\Model;

class City extends BaseModel
{


    //主后台
    public function getCity($parent_id=0){
        $data = [
            'status'=>['neq',-1],
            'parent_id'=>$parent_id,
        ];
        $order = ['listorder'=>'desc'];
        return $this->where($data)->order($order)->paginate();
    }


    //一级分类
    public function getNormalCity(){
        $data = [
            'status'=>1,
            'parent_id'=>0,
        ];
        $order = ['id'=>'desc'];
        return $this->where($data)->order($order)->select();
    }


    //商户入驻分类信息

    public function getCityByParentId($parentId = 0){
        $data = [
            'status'=>['neq',-1],
            'parent_id'=>$parentId,
        ];
        $order = ['id'=>'asc'];
        return $this->where($data)->order($order)->select();
    }

    //主页城市显示
    public function getCitys(){
        $data = [
            'status'=>1,
            'parent_id'=>['neq',0],
        ];
        $order = ['id'=>'desc'];
        return $this->where($data)->order($order)->select();
    }
}














