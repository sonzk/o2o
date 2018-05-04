<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/16
 * Time: 下午10:22
 */

namespace app\admin\controller;


use think\Controller;

class Category extends Base
{
    private $obj;

    public function _initialize(){
        $this->obj = model('Category');
    }


    //正常分类显示
    public function index(){
        $parent_id = input('get.parent_id','0','intval');
        $categorys =  $this->obj->getFirstCategory($parent_id);
        $this->assign(['categorys'=>$categorys]);
        return $this->fetch();
    }

    //添加分类页面显示
    public function add(){
        $categorys =  $this->obj->getNormalFirstCategory();
        $this->assign(['categorys'=>$categorys]);
        return $this->fetch();
    }

    //保存分类逻辑
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
        //有id存在走更新操作
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

    //编辑分类页面
    public function edit($id = 0){
        if (intval($id)<1 || !is_numeric($id)){
            $this->error('参数不合法');
        }
        $category = $this->obj->get($id);
        $categorys =  $this->obj->getNormalFirstCategory();
        $this->assign([
            'categorys'=>$categorys,
            'category'=>$category,
        ]);
        return $this->fetch();
    }


    //更新分类逻辑
    public function update($data){
        $res = $this->obj->save($data,['id'=>intval($data['id'])]);
        if ($res){
            $this->success('更新成功');
        }else{
            $this->error('更新失败');
        }
    }



}


















