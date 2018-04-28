<?php
namespace app\bis\controller;

use think\Controller;

class Index extends Base
{
    public function index()
    {
        $user = $this->getLoginUser();
        $username = $user->username;
        return $this->fetch('',[
            'username'=>$username,
        ]);
    }
}
