<?php
namespace app\common\model;

use think\Model;

class Category extends BaseModel
{

    //一级分类
    public function getNormalFirstCategory(){
        $data=[
            'status'=>1,
            'parent_id'=>0,
        ];

        $order=[
            'id'=>'desc',
        ];

        return $this->where($data)
            ->order($order)
            ->select();
    }

    public function getNormalCategoryByParentId($parent_id = 0){
        $data=[
            'status'=>1,
            'parent_id'=>$parent_id,
        ];

        $order=[
            'listorder'=>'desc',
            'id'=>'desc',
        ];

        return $this->where($data)
            ->order($order)
            ->select();
    }

    public function getFirstCategory($parent_id = 0){
        $data=[
            'status'=>['neq',-1],
            'parent_id'=>$parent_id,
        ];

        $order=[
            'listorder'=>'desc',
            'id'=>'asc',
        ];

        return $this->where($data)
            ->order($order)
            ->paginate();
    }


    //商户入驻信息
    public function getCategoryByParentId($parentId=0){
        $data=[
            'status'=>['neq',-1],
            'parent_id'=>$parentId,
        ];

        $order=[
            'id'=>'asc',
        ];

        return $this->where($data)
            ->order($order)
            ->select();
    }

    //首页一级分类显示
    public function getNormalRecommendCats($parentId=0,$limit=5){
        $data =[
            'parent_id'=>$parentId,
            'status'=>1
        ];

        $order = [
            'listorder'=>'desc',
            'id'=>'desc',
        ];

        $res = $this->where($data)
            ->order($order)
            ->limit($limit)
            ->select();

        return $res;
    }

    //根据一个父类ID数组获取二级分类数据
    public function getNormalRecommendSeCats($parentIds){
        $data = [
            'parent_id'=>['in',implode(',',$parentIds)],
            'status'=>1
        ];

        $order = [
            'listorder'=>'desc',
            'id'=>'desc',
        ];

        return $this->where($data)
            ->order($order)
            ->select();
    }

}














