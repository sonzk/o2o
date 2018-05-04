<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/26
 * Time: 下午3:32
 */

namespace app\index\controller;


class Lists extends Base
{

    public function index(){

        //获取一级分类
        $firstCat=$data=[];
        $categorys = model('Category')->getNormalCategoryByParentId();
        foreach ($categorys as $category){
            $firstCat[] = $category->id;
        }
        $id = input('get.id',0,'intval');
        if (in_array($id,$firstCat)){
            $categoryParentId = $id;
            $data['category_id']=$id;
        }elseif($id){
            $category = model('Category')::get($id);
            if (!$category || $category->status != 1){
                $this->error('操作错误');
            }
            $categoryParentId = $category->parent_id;
            $data['se_category_id']=$id;
        }else{
            $categoryParentId = 0;
        }
        $seCats =[];
        if ($categoryParentId){
            $seCats = model('Category')->getNormalCategoryByParentId($categoryParentId);
        }

        //排序
        $order_sales = input('get.order_sales','');
        $order_price = input('get.order_price','');
        $order_time = input('get.order_time','');
        //排序的不同标识
        $orders=[];
        if (!empty($order_sales)){
            $orderflag = 'order_sales';
            $orders['order_sales'] = $orderflag;
        }elseif (!empty($order_price)){
            $orderflag = 'order_price';
            $orders['order_price'] = $orderflag;
        }elseif (!empty($order_time)){
            $orderflag = 'order_time';
            $orders['order_time'] = $orderflag;
        }else{
            $orderflag ='';
        }

        $data['city_path'] = $this->city->parent_id.','.$this->city->id;

        $deals = model('Deal')->getListDeal($data,$orders);
        return $this->fetch('',[
            'categorys' => $categorys,
            'seCats'=>$seCats,
            'id'=>$id,
            'categoryParentId'=>$categoryParentId,
            'orderflag'=>$orderflag,
            'deals'=>$deals
        ]);
    }
}












