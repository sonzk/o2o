<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/23
 * Time: 下午4:02
 */

namespace app\common\model;


use think\Model;

class BaseModel extends Model
{
    protected $autoWriteTimestamp = true;


    //公用添加方法
    public function add($data){
        $data['status']=0;
        return $this->save($data);
    }

    //根据ID字段更新数据
    public function updateById($data,$id){
        //allowField 只允许写数据表字段
        return $this->allowField(true)->save($data,['id'=>$id]);
    }

}