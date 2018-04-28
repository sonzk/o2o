<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/20
 * Time: 下午8:01
 */

namespace app\bis\controller;


use think\Controller;

class Deal extends Base
{

    //
    public function index(){

        $bisId = $this->getLoginUser()->bis_id;
        $deals = model('Deal')->getDealsByBisId($bisId,['neq',0]);
        foreach ($deals as $deal){
            if ($deal->end_time < time()){
                model('Deal')->where(['id'=>$deal->id])->update(['status'=>-1]);
            }
        }
        return $this->fetch('',[
            'deals'=>$deals,
        ]);
    }

    public function wait(){

        $bisId = $this->getLoginUser()->bis_id;
        $deals = model('Deal')->getDealsByBisId($bisId,['eq',0]);

        return $this->fetch('',[
            'deals'=>$deals,
        ]);
    }

    public function add(){

        if (request()->isPost()){
            $info = input('post.');
            $data = $info['info'];
            $data['se_category_id']=empty($info['se_category_id']) ? '' : $info['se_category_id'];
            $data['location_ids']=empty($info['location_ids']) ? '' : $info['location_ids'];
            $validate = validate('Deal');
            if (!$validate->scene('add')->check($data)){
                exit(json_encode(['code'=>0,'msg'=>$validate->getError()]));
            }
            $accountId = $this->getLoginUser()->id;
            $bisId = $this->getLoginUser()->bis_id;

            $data['cat'] = '';
            if (!empty($data['se_category_id'])){
                $data['cat'] = implode(',',$data['se_category_id']);
            }
            $data['loc'] = '';
            if (!empty($data['location_ids'])){
                $data['loc'] = implode(',',$data['location_ids']);
            }
            $dealDate = [
                'name'=>$data['name'],
                'category_id'=>$data['category_id'],
                'category_path'=> $data['cat'],
                'location_ids'=>$data['loc'],
                'image'=>$data['image'],
                'description'=>empty($data['description'])?'':$data['description'],
                'start_time'=>strtotime($data['start_time']),
                'end_time'=>strtotime($data['end_time']),
                'origin_price'=>$data['origin_price'],
                'current_price'=>$data['current_price'],
                'city_id'=>$data['city_id'],
                'city_path'=>empty($data['se_city_id']) ? $data['city_id'] : $data['city_id'] . ',' . $data['se_city_id'],
                'total_count'=>$data['total_count'],
                'coupons_begin_time'=>strtotime($data['coupons_begin_time']),
                'coupons_end_time'=>strtotime($data['coupons_end_time']),
                'bis_account_id'=>$accountId,
                'bis_id'=>$bisId,
                'notes'=>empty($data['notes']) ? '' : $data['notes'],
                'buy_count'=>0
            ];
            $res = model('Deal')->add($dealDate);
            if ($res){
                return $this->success('团购商品提交成功','deal/index');
            }else{
                return $this->error('团购商品提交失败');
            }


        }else{
            $citys = model('City')->getNormalCity();
            $categorys = model('Category')->getNormalFirstCategory();
            $bisId = $this->getLoginUser()->bis_id;
            return $this->fetch('',[
                'citys'=>$citys,
                'categorys'=>$categorys,
                'bis_id'=>$bisId,

            ]);
        }
    }

    public function detail(){
        if (!request()->isGet()){
            return $this->error('参数错误');
        }
        $id = input('get.id');
        $bisId = $this->getLoginUser()->bis_id;
        $deals = model('Deal')->getDealDetail($bisId,$id);
        if (!$deals){
            $this->error('参数错误');
        }
        return $this->fetch('',[
            'deals'=>$deals,
        ]);
    }


    public function remove(){
        if (!request()->isGet()){
            $this->error('参数错误');
        }
        $data = input('get.');
        $validate = validate('Deal');
        if (!$validate->scene('remove')->check($data)){
            $this->error($validate->getError());
        }
        $deal = model('Deal')::get($data['id']);

        if ($deal->end_time < time()){
            $this->error('时间已过期，请修改',url('deal/edit',['id'=>$deal['id']]));
        }

        $bisId = $this->getLoginUser()->bis_id;
        $res = model('Deal')->save(['status'=>$data['status']],['id'=>$data['id'],'bis_id'=>$bisId]);

        if (!$res){
            $this->error('状态更新失败');
        }

        //$obj = model('Bis')->field('email')->find($data['id']);
        // 发送邮件  \phpmailer\Email::send($obj->email,$title,$content);
        $this->success('状态更新成功');
    }

    public function edit(){
        if (!request()->isGet()){
           $this->error('操作失败','deal/index');
        }
        $id = input('get.id');
        if (!is_numeric($id)){
            $this->error('操作失败','deal/index');
        }
        return $this->fetch('',['id'=>$id]);
    }

    public function save(){
        if (!request()->isPost()){
            $this->error('操作失败','deal/index');
        }
        $data = input('post.');

        if (strtotime($data['start_time']) >= strtotime($data['end_time']) || strtotime($data['coupons_begin_time']) >= strtotime($data['coupons_end_time'])){
            $this->error('开始时间不能比结束时间晚或相同');
        }
        $postData =[
            'start_time'=>strtotime($data['start_time']),
            'end_time'=>strtotime($data['end_time']),
            'coupons_begin_time'=>strtotime($data['coupons_begin_time']),
            'coupons_end_time'=>strtotime($data['coupons_end_time']),
            'status'=>1,
        ];
        $bisId = $this->getLoginUser()->bis_id;
        $res = model('Deal')->save($postData,['id'=>$data['id'],'bis_id'=>$bisId]);
        if (!$res){
            $this->error('状态更新失败');
        }

        $this->success('状态更新成功','deal/index');

    }

}







