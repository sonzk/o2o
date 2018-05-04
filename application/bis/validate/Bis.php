<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/18
 * Time: 下午9:49
 */

namespace app\common\validate;


use think\Validate;

class Bis extends Validate
{
    protected $rule = [
        ['name','require|max:30','商户名不能为空|商户名多为30个字符'],
        ['city_id','gt:0','城市未选择'],
        ['logo','require','店铺图片未选择'],
        ['licence_logo','require','执照图片未选择'],
        ['bank_info','require|number','银行信息不能为空|银行信息填写错误'],
        ['bank_name','require','开户行不能为空'],
        ['bank_user','require','开户人姓名不能空空'],
        ['faren','require','法人姓名不能为空'],
        ['faren_tel','require|number|/^1\d{10}$/','法人手机号码不能为空|手机号不正确|手机号码不正确'],
        ['email','require|email','邮箱不能为空|邮箱格式不正确'],
        ['tel','require','电话不能为空'],
        ['address','require','地址不能为空'],
        ['open_time','require|time:/^[0-2]\d{1}:[0-6]\d{1}-[0-2]\d{1}:[0-6]\d{1}$/','营业时间不能为空'],
        ['category_id','gt:0','分类未选择'],
        ['username','require|chsAlphaNum','用户名为空|用户名含有特殊字符'],
        ['password','require','密码为空'],
        ['contact','require','联系人不能为空'],
    ];

    protected $scene = [
        'add'=>[
            'name','city_id','logo','licence_logo',
            'bank_info','bank_name','bank_user','faren',
            'faren_tel','email','tel','open_time','category_id','username','password',
            'address',
        ],
        'login'=>[
            'username','password',
        ],
        'addLocation'=>['name','city_id','logo','category_id','address','tel','contact','open_time'],
    ];

    protected function time($v,$rule){
       return preg_match($rule,$v)? true : '时间填写错误';
    }
}