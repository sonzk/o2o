<?php
namespace app\bis\controller;

use think\Controller;

class Login extends Controller
{
    public function index(){
        if (request()->isPost()){
            $data = input('post.');
            $validate = validate('Bis');
            if (!$validate->scene('login')->check($data)){
                $this->error($validate->getError());
            }

            $res = model('BisAccount')->get(['username'=>$data['username'],'status'=>1]);
            if (!$res){
                $this->error('用户名不存在,或者未审核通过');
            }
            if ($res->password != md5($data['password'].$res->code)){
                $this->error('密码错误');
            }
            model('BisAccount')->updateById(['last_login_time'=>time()],$res->id);
            //bis为作用域
            session('bisAccount',$res,'bis');
            $this->success('登录成功',url('index/index'));
        }else{

            $user = session('bisAccount','','bis');
            if ($user && $user->id){
                $this->redirect(url('index/index'));
            }
            return $this->fetch();
        }
    }

    public function loginout(){
        session(null,'bis');
        $this->redirect(url('login/index'));
    }

}