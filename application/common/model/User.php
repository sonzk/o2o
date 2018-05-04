<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/23
 * Time: 下午3:16
 */

namespace app\common\model;


use think\Model;

class User extends BaseModel
{

    //前台用户注册添加逻辑
    public function add($data){
        $data['status']=1;
        $this->save($data);
        return $this->id;
    }

    //根据用户名查信息
    public function getUserByUsername($username){
        if (!$username){
            exception('用户名不合法');
        }
        $data = ['username'=>$username];

        return $this->where($data)->find();
    }
}