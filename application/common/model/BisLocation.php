<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/19
 * Time: 上午1:59
 */

namespace app\common\model;


use think\Model;

class BisLocation extends BaseModel
{


    //商家后台模块 根据商家的id查询门店
    public function getLocationsByBisId($bisId,$status=1){
        $data = [
            'bis_id'=>$bisId,
            'status'=>$status,
        ];
        $order = [
            'is_main'=>'desc',
            'update_time'=>'desc',
            'id'=>'desc'
        ];
        return $this->where($data)->order($order)->paginate();
    }

    //查询商家的店面详细，根据商家id和门店id
    public function getDetail($bisId,$id){
        $data = [
            'id'=>$id,
            'bis_id'=>$bisId,
        ];
        return $this->where($data)->find();
    }

    //主后台根据状态查询门店
    public function getLocationsByStatus($status){
        $data = [
            'status'=>$status,
        ];
        $order = [
            'id'=>'desc',
        ];
        return $this->where($data)->order($order)->paginate();
    }

    public function getLocationInId($ids){
        $data =[
            'id'=>['in',$ids],
        ];
        return $this->where($data)->select();
    }
}










