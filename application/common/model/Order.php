<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/28
 * Time: 下午3:30
 */

namespace app\common\model;

use think\Model;

class Order extends Model
{
    protected $autoWriteTimestamp = true;


    //公用添加方法
    public function add($data){
        $data['status']=1;
        $res =  $this->insertGetId($data);

        return $res;
    }
}