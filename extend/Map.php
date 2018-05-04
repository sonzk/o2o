<?php
/**
 *百度地图相关类
 */


class Map {


    /**
     * 根据地址获取经纬度
     */
    public static function getLngLat($address){
        if (!$address){
            return '';
        }
        // http://api.map.baidu.com/geocoder/v2/?
        //address=北京市海淀区上地十街10号&output=json&ak=您的ak&callback=showLocation //GET请求

        $data= [
            'address'=>$address,
            'output'=>'json',
            'ak'=>config('map.ak'),
        ];
        $str = http_build_query($data);

        $url = config('map.baidu_map_url').config('map.geocoder').'?'.$str;

        //输出url
        $result = doCurl($url);
        if($result) {
            return json_decode($result, true);
        }else {
            return [];
        }

    }


    /**
     * 根据地址或经纬度查询地图
     * @param $center  地址或经纬度
     * @return mixed|string
     */
    public static function staticimage($center){


        //http://api.map.baidu.com/staticimage/v2
        $data= [

            'ak'=>config('map.ak'),
            'width'=>config('map.width'),
            'height'=>config('map.height'),
            'center'=>$center,
            'markers'=>$center,
            'zoom' =>13,

        ];
        $str = http_build_query($data);

        $url = config('map.baidu_map_url').config('map.staticimage').'?'.$str;

        //输出url
        $result = doCurl($url);
        return $result;

    }


    public static function mapImage($center,$marker){


        //http://api.map.baidu.com/staticimage/v2
        $data= [

            'ak'=>config('map.ak'),
            'width'=>config('map.width'),
            'height'=>config('map.height'),
            'center'=>$center,
            'markers'=>$marker,
            'zoom' =>13,

        ];
        $str = http_build_query($data);

        $url = config('map.baidu_map_url').config('map.staticimage').'?'.$str;

        //输出url
        $result = doCurl($url);
        return $result;

    }
}




















