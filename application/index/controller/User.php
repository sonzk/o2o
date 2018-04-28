<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/16
 * Time: 下午9:33
 */

namespace app\index\controller;


use think\Controller;

class User extends Controller{


    //登录页面
    public function login(){

        $user = session('o2o_user','','o2o');
        if ($user && $user->id){
            $this->redirect('index/index');
        }

        return $this->fetch();
    }


    //用户注册
    public function register(){
        if (request()->isPost()){
            $info = input('post.');
            parse_str($info['info'],$data);
            $validate = validate('User');
            if (!$validate->scene('register')->check($data)){
                $this->error($validate->getError());
            }
            if (model('User')::get(['username'=>$data['username']])){
                    $this->error('用户名已存在');
            }
            if (model('User')::get(['email'=>$data['email']])){
                $this->error('邮箱已存在');
            }
            if ($data['password'] != $data['repassword']){
                $this->error('两次密码输入不一致');
            }
            if (!captcha_check($data['verifycode'])){
                $this->error('验证码不正确');
            }
            $code = mt_rand(1000,10000);
            $userData = [
                'username' => $data['username'],
                'email' => $data['email'],
                'code'=>$code,
                'password' => md5($data['password'].$code),
            ];
            $res = model('User')->add($userData);
            if ($res){
                $this->success('注册成功','index/index');
            }else{
                $this->error('注册失败');
            }
        }else{
            return $this->fetch();
        }
    }


    //检测登录信息
    public function logincheck(){
        if (!request()->isPost()){
            $this->error('操作错误');
        }
        $info = input('post.');
        parse_str($info['info'],$data);
        $validate = validate('User');
        if (!$validate->scene('login')->check($data)){
            $this->error($validate->getError());
        }
        try{
            $user = model('User')->getUserByUsername($data['username']);
        }catch ( \Exception $e){
            $this->error($e->getMessage());
        }

        if (!$user || $user->status!=1){
            $this->error('用户名不存在');
        }

        if (md5($data['password'].$user->code) != $user->password){
            $this->error('用户密码错误');
        }

        //登录成功
        model('User')->updateById(['last_login_time'=>time()],$user->id);
        //存入SESSION

        session('o2o_user',$user,'o2o');
        $this->success('登录成功','index/index');
    }


    //退出登录
    public function loginout(){
        $out = session(null,'o2o');

        if (!$out){
            $this->success('退出成功','user/login');
        }


    }
}














