<?php
namespace app\index\controller;

use think\Controller;

class Index extends Base
{
    public function index()
    {
        //首页大图
        $center = model('Featured')->getNormalFeaturedBytype(1);
        //右侧广告
        $right = model('Featured')->getNormalFeaturedBytype(2);

        //美食分类和城市查询商品数据
        $cityPath = $this->city->parent_id.','.$this->city->id;
        $time = time();
        $meishiDeal = model('Deal')->getDealByCategotyCity(5,$cityPath,$time);
        //小分类
        $meishiCat = model('Category')->getNormalRecommendCats(5,3);
        return $this->fetch('',[
            'center'=>$center,
            'right'=>$right,
            'meishiDeal'=>$meishiDeal,
            'meishiCat'=>$meishiCat,
        ]);

    }
}
