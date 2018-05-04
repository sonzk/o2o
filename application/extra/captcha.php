<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/23
 * Time: 下午1:50
 */

return [

    'useImgBg' => false,
    // 使用背景图片
    'fontSize' => 20,
    // 验证码字体大小(px)
    'useCurve' => false,
    // 是否画混淆曲线
    'useNoise' => true,
    // 是否添加杂点
    'imageH'   => 40,
    // 验证码图片高度
    'imageW'   => 200,
    // 验证码图片宽度
    'length'   => 5,
    // 验证码位数
    'fontttf'  => '',
    // 验证码字体，不设置随机获取
    'bg'       => [243, 251, 254],
    // 背景颜色
    'reset'    => true,
    // 验证成功后是否重置
];
