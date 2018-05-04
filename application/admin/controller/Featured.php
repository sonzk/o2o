<?php
/**
 * Created by PhpStorm.
 * User: lanlee
 * Date: 2018/4/22
 * Time: 下午4:55
 */

namespace app\admin\controller;


use think\Controller;

class Featured extends Base
{

    public function index(){
        $data = [];
        if (request()->isGet()){
            $type = input('get.type');
            if (!empty($type)){
                $data['type']=$type;
            }
        }
        //推荐类别具体是在配置文件中
        $featuredType = config('featured.featured_type');

        $featured = model('Featured')->getFeatured($data);
        return $this->fetch('',[
            'featuredType'=>$featuredType,
            'featured' => $featured,
            'search'=>empty($type) ? '' : $type,
        ]);
    }

    public function add(){
        if (request()->isPost()){
            $info = input('post.');
            $data = $info['info'];
            $validate = validate('Featured');
            if (!$validate->check($data)){
                $this->error($validate->getError());
            }
            $featuredDate = [
                'title'=>$data['title'],
                'type'=>$data['type'],
                'image'=>$data['image'],
                'url'=>$data['url'],
                'description'=>$data['description'],
                'status'=>0,
            ];
            $res = model('featured')->add($featuredDate);
            if ($res){
                $this->success('添加成功','featured/index');
            }else{
                $this->success('添加失败');
            }

        }else{
            $featuredType = config('featured.featured_type');
            return $this->fetch('',[
                'featuredType'=>$featuredType,
            ]);
        }
    }


}