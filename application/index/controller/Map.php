<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/25
 * Time: 下午4:51
 */

namespace app\index\controller;


use think\Controller;

class Map extends Controller
{
    public function getMapImage($data){

        return \Map::mapImage($data['center'],$data['markers']);
    }
}