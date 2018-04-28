<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/18
 * Time: 下午10:40
 */

namespace app\common\model;


use think\Model;

class Bis extends Model
{

    //根据状态查商家3为 不通过和删除的商家
    public function getBisByStatus($status=0){
        if ($status ==3){
            $data = [
                'status'=>['in','-1,2'],
            ];
            $order = [
                'status'=>'desc',
                'id'=>'desc',
            ];
        }else{
            $data = [
                'status'=>$status,
            ];
            $order = [
                'id'=>'desc',
            ];
        }

        return $this->where($data)->order($order)->paginate();
    }
}