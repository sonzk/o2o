<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/23
 * Time: 下午2:32
 */

namespace app\index\validate;


use think\Validate;

class User extends Validate
{
    protected $rule = [
        ['username','require|min:6|max:20|chsAlphaNum','用户名未填写|用户名最小为6个字符|用户名不能超过20个字符|用户名只能由汉字、英文数字'],
        ['email','require|email','邮箱未填写|邮箱格式不正确'],
        ['password','require|min:6','密码未填写|密码最小应为6个字符'],
        ['repassword','require','请输入确认入密码'],
        ['verifycode','require','验证码未填写']
    ];

    protected $scene = [
        'register'=>['username','email','password','repassword','verifycode'],
        'login'=>['username','password']
    ];


}