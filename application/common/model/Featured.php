<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/22
 * Time: 下午8:23
 */

namespace app\common\model;


use think\Model;

class Featured extends BaseModel
{


    //主后台推荐位查询
    public function getFeatured($data){
        $order = [
            'id'=>'desc',
        ];
        return $this->where($data)->order($order)->paginate();
    }

    public function getNormalFeaturedBytype($type){
        $data = [
            'type'=>$type,
            'status'=>1
        ];

        return $this->where($data)->select();
    }


}