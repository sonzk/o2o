<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/28
 * Time: 下午1:53
 */

namespace app\index\controller;


class Order extends Base
{

    public function index(){
        $user = $this->getLoginUser();
        if (!$user){
            $this->error('未登陆，请先登录','user/login');
        }
        $data = input('get.');
        $validate = validate('Order');
        if (!$validate->scene('index')->check($data)){
            $this->error($validate->getError());
        }
        $deal = model('Deal')->find($data['id']);
        if (!$deal || $deal->status != 1){
            $this->error('商品不存在');
        }
        if (empty($_SERVER['HTTP_REFERER'])){
            $this->error('请求不合法');
        }

        $orderSn = setOrderSn();
        $orderData = [
            'out_trade_no'=>$orderSn,
            'user_id'=>$user->id,
            'username'=>$user->username,
            'deal_id'=>$data['id'],
            'total_price'=>$data['total_price'],
            'deal_count'=>$data['deal_count'],
            'referer'=>$_SERVER['HTTP_REFERER'],
        ];

        try{
            $orderId = model('Order')->add($orderData);
        }catch ( \Exception $e){
            $this->error($e->getMessage());
        }
        $this->redirect('pay/index',['id'=>$orderId]);
    }

    public function confirm(){

        if (!$this->getLoginUser()){
            $this->error('未登陆，请先登录','user/login');
        }

        $data = input('get.');
        $validate = validate('Order');
        if (!$validate->scene('confirm')->check($data)){
            $this->error($validate->getError());
        }

        $deal = model('Deal')->find($data['id']);
        if (!$deal || $deal->status != 1){
            $this->error('商品不存在');
        }
        $deal = $deal->toArray();
        return $this->fetch('',[
            'controller'=>'pay',
            'count'=>$data['count'],
            'deal'=>$deal,
        ]);
    }
}