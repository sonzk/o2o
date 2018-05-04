<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/23
 * Time: 下午6:14
 */

namespace app\index\controller;


use think\Controller;

class Base extends Controller
{

    protected $city;
    protected $account;

    //默认数据
    public function _initialize()
    {
        //城市数据
        $citys = model('City')->getCitys();
        $this->getCity($citys);

        //分类数据
        $cats = $this->getRecommendCategory();

        //传递控制器名
        $controller = request()->controller();
        $this->assign([
            'citys'=>$citys,
            'city'=>$this->city,
            'user'=>$this->getLoginUser(),
            'cats'=>$cats,
            'controller'=>strtolower($controller),
            'title'=>'o2o团购网',

        ]);
    }

    //获取主页城市信息，点击更改
    public function getCity($citys){
        $defaultname ='';
        foreach ($citys as $city){
            if ($city->is_default == 1){
                $defaultname = $city->name;
                break;
            }
        }

        $defaultname = $defaultname ? $defaultname : '北京';

        if (session('cityname','','o2o') && !input('get.city')){
            $cityname = session('cityname','','o2o');
        }else{
            $cityname = input('get.city',$defaultname,'trim');
            session('cityname',$cityname,'o2o');
        }
        $this->city = model('City')->where(['name'=>$cityname])->find();
    }

    //获取登录用户信息，存在则直接返回
    public function getLoginUser(){
        if (!$this->account || !$this->account->id){
            $this->account = session('o2o_user','','o2o');
        }
        return $this->account;
    }

    //首页分类显示
    public function getRecommendCategory(){
        $parentIds = [];
        $SeCatArr =[];
        $recommendCats =[];

        //获取一类分类id
        $cats = model('Category')->getNormalRecommendCats(0,5);
        foreach ($cats as $cat){
            $parentIds[] = $cat->id;
        }

        //根据一级分类id得到二级分类数据
        $seCats = model('Category')->getNormalRecommendSeCats($parentIds);
        foreach($seCats as $seCat){
            $SeCatArr[$seCat->parent_id][] = [
                'id'=>$seCat->id,
                'name'=>$seCat->name,
            ];
        }

        //组装一级分类的name和二级分类的name
        foreach ($cats as $cat){
            $recommendCats[$cat->id] = ['name'=>$cat->name,empty($SeCatArr[$cat->id]) ? '':$SeCatArr[$cat->id] ];
        }
        return $recommendCats;
    }
}
















