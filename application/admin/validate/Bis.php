<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/19
 * Time: 下午9:46
 */

namespace app\admin\validate;


use think\Validate;

class Bis extends Validate
{
    protected $rule = [
        ['id','number|require'],
        ['status','number|in:-1,0,1,2','状态为数字|状态不正确'],
    ];

    protected $scene =[
        'status'=>['id','status'],
    ];
}