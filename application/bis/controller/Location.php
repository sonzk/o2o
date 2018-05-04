<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/20
 * Time: 下午8:32
 */

namespace app\bis\controller;


class Location extends Base
{

    public function index(){
        $bisId = $this->getLoginUser()->bis_id;
        $locations = model('BisLocation')->getLocationsByBisId($bisId);
        return $this->fetch('',[
            'locations'=>$locations,
        ]);
    }

    public function wait(){

        $bisId = $this->getLoginUser()->bis_id;
        $locations = model('BisLocation')->getLocationsByBisId($bisId,['neq',1]);
        return $this->fetch('',[
            'locations'=>$locations,
        ]);
    }

    public function add(){

        if (request()->isPost()){
            $info = input('post.');
            $data = $info['info'];
            $data['se_category_id']=empty($info['se_category_id']) ? '' : $info['se_category_id'];
            $validate = validate('Bis');
            if (!$validate->scene('addLocation')->check($data)){
                exit(json_encode(['code'=>0,'msg'=>$validate->getError()]));
            }

            $lnglat = \Map::getLngLat($data['address']);
            if (empty($lnglat) || $lnglat['status'] != 0 || $lnglat['result']['precise'] == 0){
                exit(json_encode(['code'=>0,'msg'=>'输入地址匹配不精确']));
            }

            $bisId = $this->getLoginUser()->bis_id;
            $data['cat'] = '';
            if (!empty($data['se_category_id'])) {
                $data['cat'] = implode(',', $data['se_category_id']);
            }

            $locationData = [
                'name'=>$data['name'],
                'logo'=>$data['logo'],
                'address'=>$data['address'],
                'tel'=>$data['tel'],
                'contact'=>$data['contact'],
                'bis_id'=>$bisId,
                'open_time'=>$data['open_time'],
                'content'=>$data['content'],
                'city_id'=>$data['city_id'],
                'city_path'=>empty($data['se_city_id']) ? $data['city_id'] : $data['city_id'] . ',' . $data['se_city_id'],
                'category_id'=>$data['category_id'],
                'category_path'=>$data['cat'],
                'is_main'=>0,
                'xpoint'=>$lnglat['result']['location']['lng'],
                'ypoint'=>$lnglat['result']['location']['lat'],
            ];
            $res = model('BisLocation')->add($locationData);
            if ($res){
                return $this->success('申请提交成功','location/index');
            }else{
                return $this->success('申请提交失败');
            }

        }else {


            $citys = model('City')->getNormalCity();
            $categorys = model('Category')->getNormalFirstCategory();
            return $this->fetch('', [
                'citys' => $citys,
                'categorys' => $categorys,

            ]);
        }
    }

    public function detail(){
        if (!request()->isGet()){
            return $this->error('参数错误');
        }
        $id = input('get.id');
        $bisId = $this->getLoginUser()->bis_id;
        $location = model('BisLocation')->getDetail($bisId,$id);
        if (!$location){
           return ;
        }
        return $this->fetch('',[
            'location'=>$location,
        ]);
    }
}