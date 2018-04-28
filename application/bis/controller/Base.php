<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/20
 * Time: 上午12:19
 */

namespace app\bis\controller;


use think\Controller;

class Base extends Controller  //公共方法，验证登录
{
    //避免重复条用
   protected $account;

   //初始化验证登录
   public function _initialize(){
      $isLogin = $this->isLogin();
      if (!$isLogin){
          $this->redirect('login/index');
      }
   }
    //验证是否登录
   public function isLogin(){
       $user = $this->getLoginUser();
       if ($user && $user->id){
           return true;
       }
       return false;
   }
    //查询SESSION用户
   public function getLoginUser(){
       if (!$this->account || !$this->account->id){
           $this->account = session('bisAccount','','bis');
       }

       return $this->account;
   }
}