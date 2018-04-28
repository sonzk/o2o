<?php
namespace app\admin\validate;

use think\Validate;

class Category extends Validate {

    //规则
    protected $rule = [
        ['name','require|max:10','分类名不能为空|分类名不能超过10个字符'],
        ['status','number|in:-1,0,1,2','状态为数字|状态不正确'],
        ['parent_id','number'],
        ['id','number'],
        ['listorder','number|require','排序应为数字|不能为空'],
    ];

    //场景设置
    protected $scene = [
        'add'=>['name','parent_id','id'],
        'listorder'=>['id','listorder'],
        'status'=>['id','status'],
    ];
}