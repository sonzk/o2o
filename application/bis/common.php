<?php

//商品状态
function dealstatus($status){
    if ($status == 1 ){
        $str = '<span class="label label-success radius" >正常</span>';
    }elseif ($status == 0){
        $str = '<span class="label label-danger radius" >待审</span>';
    }elseif ($status == 2){
        $str = '<span class="label label-danger radius" >未通过</span>';
    }else{
        $str = '<span class="label label-danger radius" >已下架</span>';
    }
    return $str;
}