<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/28
 * Time: 下午3:35
 */

namespace app\index\controller;


use think\Controller;

class Pay extends Controller
{
    public function index(){
        var_dump(input('get.'));
    }
}