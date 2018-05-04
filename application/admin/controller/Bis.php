<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/17
 * Time: 下午1:37
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;

class Bis extends Controller
{


    //正常商户显示
    public function index(){
        $bis = model('Bis')->getBisByStatus(1);
        return $this->fetch('',[
            'bis'=>$bis,
        ]);
    }

    //待审商户显示
    public function apply(){

        $bis = model('Bis')->getBisByStatus();
        return $this->fetch('',[
            'bis'=>$bis,
        ]);
    }

    //删除和未通过商户显示
    public function dellist(){

        $bis = model('Bis')->getBisByStatus(3);
        return $this->fetch('',[
            'bis'=>$bis,
        ]);
    }

    //商户详情显示
    public function detail(){
        if (!request()->isGet()){
            $this->error('参数错误');
        }

        $bisId = intval(input('get.id'));
        $bisData = model('Bis')::get($bisId);
        $locationData = model('BisLocation')::get(['bis_id'=>$bisId]);
        $accountData = model('BisAccount')::get(['bis_id'=>$bisId]);
        return $this->fetch('',[
            'bis'=>$bisData,
            'location'=>$locationData,
            'account'=>$accountData,
        ]);
    }

    //商户状态更改，改商户，连同门店，账号一起修改
    public function status(){
        if (!request()->isGet()){
            $this->error('参数错误');
        }
        $data = input('get.');
        $validate = validate('Bis');
        if (!$validate->scene('status')->check($data)){
            $this->error($validate->getError());
        }
        Db::startTrans();
        try{
            Db::name('bis')->where(['id'=>$data['id']])->update(['status'=>$data['status']]);
            Db::name('bis_location')->where(['bis_id'=>$data['id']])->update(['status'=>$data['status']]);
            Db::name('bis_account')->where(['bis_id'=>$data['id']])->update(['status'=>$data['status']]);
            Db::name('deal')->where(['bis_id'=>$data['id']])->update(['status'=>$data['status']]);
            Db::commit();
        }catch (\Exception $e){
            Db::rollback();
            $this->error($e->getMessage());
        }

        //$obj = model('Bis')->field('email')->find($data['id']);
        // 发送邮件  \phpmailer\Email::send($obj->email,$title,$content);
        $this->success('状态更新成功');
    }
}


















