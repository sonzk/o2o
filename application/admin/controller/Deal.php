<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/21
 * Time: 下午9:31
 */

namespace app\admin\controller;


use think\Controller;

class Deal extends Base
{


    //正常商品显示,有查询逻辑
    public function index(){
        if (!request()->isGet()){
            $this->error('参数错误');
        }
        $data = input('get.');
        $sdata = [];
        if (!empty($data['category_id'])){         //判断是否有分类查询条件
            $sdata['category_id'] = $data['category_id'];
        }
        if (!empty($data['city_id'])){         //判断是否有省份类查询条件
            $sdata['city_id'] = $data['city_id'];
        }
        if (!empty($data['se_city_id'])){         //判断是否有城市类查询条件
            $sdata['city_path'] = $data['city_id'].','.$data['se_city_id'];
            $seCity = model('City')->field(['id','name'])->where(['parent_id'=>$data['city_id']])->select();
        }

        //判断是否有时间类查询条件
        if (!empty($data['start_time']) && !empty($data['end_time']) && strtotime($data['start_time'])<strtotime($data['end_time'])){
            $sdata['create_time']=[
                ['gt',strtotime($data['start_time'])],
                ['lt',strtotime($data['end_time'])],
            ];
        }

        if (!empty($data['name'])){                //判断是否有商品名模糊查询条件
            $sdata['name'] = ['like','%'.$data['name'].'%'];
        }

        //是否存在status，存在就是显示非正常商品
        if (!empty($data['status']) && $data['status']=='del'){
            $status = ['in','-2,-1,2'];
        }else{
            $status = 1;
        }

        //sdata为条件，根据条件和状态查询出结果
        $deals = model('Deal')->getNormalDeals($sdata,$status);

        //所有一个分类显示
        $categorys = model('Category')->getNormalFirstCategory();

        //所有一个城市显示
        $citys = model('City')->getNormalCity();
        return $this->fetch('',[
            'deals'=>$deals,
            'categorys'=>$categorys,
            'citys'=>$citys,
            'category_id'=>empty($data['category_id'])?'':$data['category_id'],
            'city_id'=>empty($data['city_id'])?'':$data['city_id'],
            'se_city_id'=>empty($data['se_city_id'])?'':$data['se_city_id'],
            'se_city'=>empty($seCity)?'':$seCity,
            'start_time'=>empty($data['start_time'])?'':$data['start_time'],
            'end_time'=>empty($data['end_time'])?'': $data['end_time'],
            'name'=>empty($data['name'])?'':$data['name'],
        ]);
    }


    //待审页面
    public function apply(){

        $deals = model('Deal')->getDealsByStatus();
        return $this->fetch('',[
            'deals'=>$deals,
        ]);
    }

    //详情页
    public function detail(){
        if (!request()->isGet()){
            return $this->error('参数错误');
        }
        $id = input('get.id');

        $deals = model('Deal')::get($id);
        if (!$deals){
            $this->error('参数错误');
        }
        return $this->fetch('',[
            'deals'=>$deals,
        ]);
    }


}








