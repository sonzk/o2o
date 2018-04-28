<?php


//商户入驻分类信息提示

function show ($status,$msg='',$data=[]){

    return [
        'status'=>$status,
        'msg'=>$msg,
        'data'=>$data,
    ];
}