<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/21
 * Time: 下午4:22
 */

namespace app\common\model;


use think\Model;

class Deal extends BaseModel
{


    //商家后台显示正常商品
    public function getDealsByBisId($bisId,$status=1){
        $data = [
            'bis_id'=>$bisId,
            'status'=>$status
        ];
        $order = [
            'id'=>'desc',
        ];
        return $this->where($data)->order($order)->paginate();
    }


    //商家后台商品详情
    public function getDealDetail($bisId,$id){
        $data = [
            'bis_id'=>$bisId,
            'id'=>$id,
        ];
        return $this->where($data)->find();
    }

    //主后台待审商品
    public function getDealsByStatus($status = 0){
        $data = [
            'status'=>$status,

        ];
        $order = [
            'create_time'=>'desc',
        ];
        return $this->where($data)->order($order)->paginate();
    }


    //根据条件查询商品
    public function getNormalDeals($data,$status){
        $data['status'] = $status;
        $order = [
            'status'=>'desc',
            'id'=>'desc',
        ];
        return $this->where($data)->order($order)->paginate();
    }

    public function getDealByCategotyCity($categoryId,$cityPath,$time,$limit=10){
        $data = [
            'category_id'=>$categoryId,
            'city_path'=>$cityPath,
            'coupons_end_time'=>['gt',$time],
            'status'=>1,
        ];

        $order = [
            'listorder'=>'desc',
            'id'=>'desc',
        ];

        $res = $this->where($data)->order($order);

        if ($limit){
            $res = $res->limit($limit);
        }
        return $res->select();
    }


    //列表页
    public function getListDeal($data=[],$orders){
       //条件数据重组

        if (!empty($data['se_category_id'])){       //find_in_set设置在se_category_id中有的都可以显示
            $datas[]= " find_in_set(".$data['se_category_id'].",category_path)";
        }
        if (!empty($data['category_id'])){
            $datas[]= ' category_id = '.$data['category_id'];
        }
        if (!empty($data['city_path'])){
            $datas[]='city_path = "'.$data['city_path'].'"';  //city_path字段是字符串形式，数据要加引号；
        }
        $datas[]='end_time>'.time();
        $datas[]='status=1';
        $d = implode(' AND ',$datas);  //AND 隔开组成SQL

        //排序处理
        if (!empty($orders['order_sales'])) {
            $order['buy_count'] = 'desc';
        }
        if (!empty($orders['order_price'])) {
            $order['current_price'] = 'desc';
        }
        if (!empty($orders['order_time'])) {
            $order['create_time'] = 'desc';
        }
        $order['id']='desc';

        $res = $this->where($d)->order($order)->paginate();
        return $res;
    }
}










