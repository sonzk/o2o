<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/22
 * Time: 下午6:02
 */

namespace app\admin\validate;


use think\Validate;

class Featured extends Validate
{
    protected $rule = [
        ['title','require|max:25','标题不能为空|长度不能超过25个字符'],
        ['image','require','图片不能为空'],
        ['type','gt:0|number','所属分类不能为空'],
        ['url','require'],
        ['description','require','简介不能为空'],

    ];

}