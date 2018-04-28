<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/21
 * Time: 下午2:41
 */

namespace app\api\controller;


use think\Controller;

class Location extends Controller
{

    //根据城市查找门店
    public function getLocationByCityPath(){
        $cityPath = input('post.path');
        $bisId = input('post.bis_id');
        $data = [
            'city_path'=>$cityPath,
            'bis_id'=>$bisId,
        ];
        $location = model('BisLocation')->field(['id','name','bis_id'])
            ->where($data)
            ->select();
        if ($location){
           return show(1,'success',$location);
        }else{
            return show(0,'error');
        }
    }
}