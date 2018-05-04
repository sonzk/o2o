<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/21
 * Time: 上午1:52
 */

namespace app\admin\controller;


use think\Controller;

class Location extends Base
{

    //正常门店显示
    public function index(){

        $locations = model('BisLocation')->getLocationsByStatus(1);
        return $this->fetch('',[
            'locations'=>$locations,
        ]);
    }
    //待审门店显示
    public function apply(){
        $locations = model('BisLocation')->getLocationsByStatus(0);
        return $this->fetch('',[
            'locations'=>$locations,
        ]);
    }
    //删除门店显示
    public function dellist(){
        $locations = model('BisLocation')->getLocationsByStatus(-1);
        return $this->fetch('',[
            'locations'=>$locations,
        ]);
    }
    //门店详情显示
    public function detail(){
        if (!request()->isGet()){
            return $this->error('参数错误');
        }
        $id = input('get.id');
        $location = model('BisLocation')->get($id);
        if (!$location){
            return ;
        }
        return $this->fetch('',[
            'location'=>$location,
        ]);
    }


}