<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/28
 * Time: 下午2:23
 */

namespace app\index\validate;


use think\Validate;

class Order extends Validate
{

    protected $rule = [
        ['id','require|number','操作错误|操作错误'],
        ['count','require|number','操作错误|操作错误'],
        ['total_price','require|number','操作错误|操作错误'],
        ['deal_count','require|number','操作错误|操作错误']

    ];

    protected $scene = [

        'confirm'=>['id','count'],
        'index'=>['id','deal_count','total_price']
    ];
}