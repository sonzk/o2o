<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/22
 * Time: 下午9:04
 */

namespace app\admin\controller;


use think\Controller;

class Base extends Controller
{
    /**
     * 修改状态，公共方法,
     */
    public function status(){
        if (!request()->isGet()){
            $this->error('参数错误');
        }
        $data = input('get.');
        $validate = validate('Bis');
        if (!$validate->scene('status')->check($data)){
            $this->redirect('featured/index');
        }

        $model = request()->controller();

        $res = model($model)->save(['status'=>$data['status']],['id'=>$data['id']]);
        if (!$res){
            $this->error('状态更新失败');
        }

        //$obj = model('Bis')->field('email')->find($data['id']);
        // 发送邮件  \phpmailer\Email::send($obj->email,$title,$content);
        $this->success('状态更新成功');
    }

    /**
     * 排序值修改
     * @param  $id  修改的id
     * @param $listorde  排序值
     */
    public function listorder($id,$listorder){
        $validate = validate('Category');
        //validata验证数据
        if (!$validate->scene('listorder')->check(['id'=>$id,'listorder'=>$listorder])){
            $this->result($_SERVER['HTTP_REFERER'],0,$validate->getError());
        }
        $model = request()->controller();
        //更新到数据库
        $res = model($model)->save(['listorder'=>$listorder],['id'=>intval($id)]);
        if ($res){
            $this->result($_SERVER['HTTP_REFERER'],1,'成功');
        }else{
            $this->result($_SERVER['HTTP_REFERER'],0,'失败');
        }
    }


}