<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/25
 * Time: 下午2:15
 */

namespace app\index\controller;


class Detail extends Base
{

    public function index($id){

        if (!$id){
            $this->error('ID不合法');
        }

        $deal = model('Deal')::get($id);
        if (!$deal || $deal->status != 1){
            $this->error('商品不存在','index/index');
        }
        $bisId = $deal->bis_id;
        $bisData = model('Bis')::get($bisId);
        $location = model('BisLocation')->getLocationInId($deal->location_ids);
        $category = model('Category')::get($deal->category_id);

        $mapData = [
            'center'=> $this->city->name,
            'markers'=>$this->getMapstr($location),
        ];

        //时间是否开始
        $flag = 0;
        if ($deal->start_time > time()){
            $flag = 1;
            $dtime = $deal->start_time-time();
            $h = floor($dtime/3600);
            $timedata = [
                'h'=>0,
                'i'=>0,
                's'=>0
            ];
            if ($h){
                $timedata['h']= $h;
            }
            $i = floor($dtime%3600/60);
            if ($i){
                $timedata['i']= $i;
            }
            $s = $dtime%3600%60;
            if ($s){
                $timedata['s']= $s;
            }
        }

        return $this->fetch('',[
            'deal'=>$deal,
            'title'=>$deal->name,
            'category'=>$category,
            'overplus'=>$deal->total_count-$deal->buy_count,
            'flag'=>$flag,
            'timedate'=>empty($timedata)? '': $timedata,
            'location'=>$location,
            'mapData'=>$mapData,
            'bisData'=>$bisData,
        ]);
    }

    public function getMapstr($location){
        $mapstr = '';
        foreach ($location as $v){
            $mapstr .= $v->xpoint.','.$v->ypoint.'|';
        }
        return substr($mapstr,0,-1);
    }
}











