<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


//状态显示
function status($status){
    if ($status == 1 ){
        $str = '<span class="label label-success radius" >正常</span>';
    }elseif ($status == 0){
        $str = '<span class="label label-danger radius" >待审</span>';
    }elseif ($status == 2){
        $str = '<span class="label label-danger radius" >未通过</span>';
    }else{
        $str = '<span class="label label-danger radius" >删除</span>';
    }
    return $str;
}


//地图curl方式输出
function doCurl($url,$type=0,$data=[]){
    //初始化
    $ch = curl_init();
    //设置选项
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_HEADER,0);

    if ($type == 1){
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
    }

    $output = curl_exec($ch);
    curl_close($ch);
    return $output;

}


//审核提示
function bisRegister($status){
    if($status == 1){
        $str = "入驻申请成功 ";
    }elseif ($status == 0){
        $str = '入驻申请已提交，正在审核，审核通过后会有邮件通通知';
    }elseif ($status ==2 ){
        $str = '提交的材料不符合，请重新提交';
    }else{
        $str = '该申请已被删除';
    }
    return $str;
}

//通用分页样式分页
function pagination($obj){
    if (!$obj){
        return '';
    }

    //保留URL上的其他参数
    $params = request()->param();
    return '<div class="mt-20 page">'.$obj->appends($params)->render().'</div>';
}



function getCityByPath($id){
    if (!$id){
        return '';
    }

    $city = model('City')->field('name')->find($id);
    $name = $city->name;
    return $name;
}


//根据城市分类id,查城市名
function getSeCityByPath($id){
    if (!$id){
        return '';
    }
    if(preg_match('/,/',$id)){
        $cityId = explode(',',$id);
        //二级城市名
        $city = model('City')::get($cityId[1]);
        $name = $city->name;
        return $name;
    }else{
        return '未选择';
    }
}

//根据city_path获取省份和城市
function getCityName($id){
    if (!$id){
        return '';
    }
    if(preg_match('/,/',$id)){
        $cityId = explode(',',$id);
        //二级城市名
        $c = model('City')::get($cityId[0]);
        $city = model('City')::get($cityId[1]);
        $name = $c->name;
        $name .= $city->name;
        return $name;
    }else{
        $c = model('City')::get($id);
        $name = $c->name;
        return $name;
    }
}


//获取二级分类名
function getSeCategoryName($id){
    if (!$id){
        return '无';
    }
    if(preg_match('/,/',$id)) {

        $se_category = explode(',', $id);

        $category ='' ;
        foreach ($se_category as $v) {
            if ($v ==''){
                continue;
            }
            $obj = model('Category')::get($v);
            $category .= '  '.$obj->name;
        }
        return $category;
    }else{
        return '无';
    }
}

//获取一级分类名
function getCategoryName($id){
    if (!$id){
        return '';
    }

    $obj = model('Category')::get($id);
    $category = $obj->name;
    return $category;

}

//根据商户ID获取商户名
function getBisNameById($id){
    if (!$id){
        return '';
    }

    $obj = model('Bis')->field('name')->find(['id'=>$id]);
    $name = $obj->name;
    return $name;
}



//根据门店ID获取门店名
function getLocationName($locationIds){
    if (!$locationIds){
        return '';
    }
    if (preg_match('/,/',$locationIds)){
        $loacation = explode(',',$locationIds);
        $loacationName='';
        foreach ($loacation as $v){
            $obj= model('BisLocation')->field('name')->find(['id'=>$locationIds]);
            $loacationName .= $obj->name.' ';
        }
    }else{
        $loacationName = model('BisLocation')->field('name')->find(['id'=>$locationIds]);
    }
    return $loacationName;

}

//根据门店ID获取门店名
function getLocationCount($locationIds){
    if (!$locationIds){
        return 1;
    }
    if (preg_match('/,/',$locationIds)) {
        $loacation = explode(',', $locationIds);
        $count = count($loacation);
        return $count;
    }else{
        return 1;
    }

}

function setOrderSn(){
    list($t1,$t2) =explode(' ',microtime());
    $t3 = explode('.',$t1*10000);

    $orderSn = $t2.$t3[0].mt_rand(10000,99999);
    return $orderSn;
}





