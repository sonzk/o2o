<?php
namespace app\bis\controller;

use app\common\model\Bis;
use phpmailer\Email;
use think\Controller;
use think\Db;
use think\Model;

class Register extends Controller
{

    //商户入驻申请
    public function index(){

        $citys = \model('City')->getCityByParentId();
        $category = \model('Category')->getCategoryByParentId();
        return $this->fetch('',[
            'citys'=>$citys,
            'categorys'=>$category,
        ]);
    }



    //商家注册
    public function add(){
        $info = input('post.');
        $data = $info['info'];
        $data['se_category_id']=empty($info['se_category_id']) ? '': $info['se_category_id'];
        $validate = validate('Bis');

        //信息校验
        if(!$validate->scene('add')->check($data)){
            exit(json_encode(['code'=>0,'msg'=>$validate->getError()]));
        }

        //验证是否有相同邮箱
        $emailCheck =\model('Bis')->get(['email'=>$data['email']]);
        if($emailCheck){
            exit(json_encode(['code'=>0,'msg'=>'邮箱已存在']));
        }

        //验证是否有相同用户名
        $userCheck = \model('BisAccount')->get(['username'=>$data['username']]);
        if ($userCheck){
            exit(json_encode(['code'=>0,'msg'=>'用户名已存在']));
        }

        //地址验证是否精准
        $lnglat = \Map::getLngLat($data['address']);
        if (empty($lnglat) || $lnglat['status'] != 0 || $lnglat['result']['precise'] == 0){
            exit(json_encode(['code'=>0,'msg'=>'输入地址匹配不精确']));
        }
        $time = time();

        //开启事务，三张表的数据入库
        Db::startTrans();
    try {
        //商户表数据
        $bisData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'logo' => $data['logo'],
            'licence_logo' => $data['licence_logo'],
            'description' => empty($data['description']) ? '' : $data['description'],
            'city_id' => $data['city_id'],
            'city_path' => empty($data['se_city_id']) ? $data['city_id'] : $data['city_id'] . ',' . $data['se_city_id'],
            'bank_info' => $data['bank_info'],
            'bank_name' => $data['bank_name'],
            'bank_user' => $data['bank_user'],
            'faren' => $data['faren'],
            'faren_tel' => $data['faren_tel'],
            'create_time'=>$time,
            'update_time'=>$time,
        ];

        $bisId = Db::name('bis')->insertGetId($bisData);

        //总店相关信息
        $data['cat'] = '';
        if (!empty($data['se_category_id'])) {
            $data['cat'] = implode(',', $data['se_category_id']);
        }
        $bisLocationData = [
            'name' => $data['name'],
            'logo' => $data['logo'],
            'address' => $data['address'],
            'open_time' => $data['open_time'],
            'tel' => $data['tel'],
            'contact' => $data['contact'],
            'content' => empty($data['content']) ? '' : $data['content'],
            'city_id' => $data['city_id'],
            'city_path' => empty($data['se_city_id']) ? $data['city_id'] : $data['city_id'] . ',' . $data['se_city_id'],
            'is_main' => 1,
            'category_id' => $data['category_id'],
            'category_path' => $data['cat'],
            'bank_info' => $data['bank_info'],
            'xpoint' => $lnglat['result']['location']['lng'],
            'ypoint' => $lnglat['result']['location']['lat'],
            'bis_id' => $bisId,
            'create_time'=>$time,
            'update_time'=>$time,
        ];
        $locationId = Db::name('bis_location')->insertGetId($bisLocationData);


        //商户商户表相关信息
        $code = mt_rand(100,10000);
        $bisAccountData = [
            'username'=>$data['username'],
            'is_main'=>1,
            'code'=>$code,
            'password'=>md5($data['password'].$code),
            'bis_id' => $bisId,
            'create_time'=>$time,
            'update_time'=>$time,
        ];
       $accountId = Db::name('bis_account')->insertGetId($bisAccountData);
        Db::commit();
    }catch (\Exception $e){
        Db::rollback();
        exit(json_encode(['code'=>0,'msg'=>'数据写入失败']));
    }

    //成功发送邮件
       // Email::send($data['email'],'o2o商户入驻申请','o2o商户入驻申请，请等待审核，审核通过后将会有邮件通知，请及时关注');
        exit(json_encode(['code'=>1,'bisId'=>$bisId]));
    }


    //点击按钮查询，用户名，邮箱是否存在， 地址具体经纬度
    public function maptag(){
            $check = input('post.check');
            if (!empty($check)){
                if ($check == 1){
                    $emailCheck =\model('Bis')->get(['email'=>input('post.email')]);
                    if($emailCheck){
                        exit(json_encode(['code'=>0,'msg'=>'邮箱已存在']));
                    } else{
                        exit(json_encode(['code'=>1,'msg'=>'恭喜，邮箱可用']));
                    }
                }elseif ($check == 2){
                    $userCheck = \model('BisAccount')->get(['username'=>input('post.username')]);
                    if ($userCheck){
                        exit(json_encode(['code'=>0,'msg'=>'用户名已存在']));
                    }else{
                        exit(json_encode(['code'=>1,'msg'=>'用户名可用']));
                    }
                }elseif ($check == 3){
                    $map =  \Map::getLngLat(input('post.address'));
                    if ($map['status']==0){
                        exit(json_encode([
                            'code'=>1,
                            'lng'=>round($map['result']['location']['lng'],4),
                            'lat'=>round($map['result']['location']['lat'],4),
                        ]));
                    }else{
                        exit(json_encode(['code'=>0,'msg'=>'地址错误']));
                    }
                }
            }
    }

    //注册提交成功后跳转页面
    public function waiting($id){
        if (empty($id)){
            $this->error('error');
        }
        $status = \model('Bis')->field('status')->where(['id'=>$id])->find();
        return $this->fetch('',['status'=>$status]);

    }


}









