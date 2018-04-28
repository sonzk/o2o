<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/16
 * Time: 下午10:22
 */

namespace app\admin\controller;


use think\Controller;

class City extends Base
{
    private $obj;

    public function _initialize(){
        $this->obj = model('City');
    }

    public function index(){
        $parent_id = input('get.parent_id','0','intval');
        $city =  $this->obj->getCity($parent_id);
        $this->assign(['city'=>$city]);
        return $this->fetch();
    }

    public function add(){
        $city =  $this->obj->getNormalCity();
        $this->assign(['city'=>$city]);
        return $this->fetch();
    }

    public function save(){
        if (!request()->isPost()){
            $this->error('请求失败');
        }
        $data = input('post.');
        //validate验证数据
        $validate = validate('Category');
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        if (!empty($data['id'])){
            $this->update($data);
        }

        //新增分类
        $res =  $this->obj->add($data);
        if ($res){
            $this->success('新增成功');
        }else{
            $this->error('新增失败');
        }
    }

    public function edit($id = 0){
        if (intval($id)<1 || !is_numeric($id)){
            $this->error('参数不合法');
        }
        $cityname = $this->obj->get($id);
        $city =  $this->obj->getNormalCity();
        $this->assign([
            'city'=>$city,
            'cityname'=>$cityname,
        ]);
        return $this->fetch();
    }


    public function update($data){
        $res = $this->obj->save($data,['id'=>intval($data['id'])]);
        if ($res){
            $this->success('更新成功');
        }else{
            $this->error('更新失败');
        }
    }



}


















