<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"/Users/lanlee/Sites/o2o/public/../application/index/view/user/login.html";i:1524923684;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>登录</title>
    <link rel="stylesheet" href="/o2o/public/static/index/css/base.css" />
    <link rel="stylesheet" href="/o2o/public/static/index/css/login.css" />
    <script type="text/javascript" src="/o2o/public/static/index/js/html5shiv.js"></script>
    <script type="text/javascript" src="/o2o/public/static/index/js/respond.min.js"></script>
    <script type="text/javascript" src="/o2o/public/static/index/js/jquery-1.11.3.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <div class="head">
            <ul>
                <li><a href="<?php echo url('index/index'); ?>"><img src="/o2o/public/static/index/image/logo.png" alt="logo"></a></li>
                <li class="divider"></li>
                <li>登录</li>
            </ul>
            <div class="login-link">
                <span>还没o2o团购网帐号</span>
                <a href="<?php echo url('user/register'); ?>">注册</a>
            </div>
        </div>

        <div class="content">
            <div class="wrap">
                <div class="login-logo"><img src="//gss0.bdstatic.com/8r1VfDn9KggZnd_b8IqT0jB-xx1xbK/static/user/img/login-logo_30a0915.png"></div>
                <div class="login-area">
                    <div class="title">登录</div>
                    <div class="login">
                        <form  id="login" method="post">
                            <div class="ordinaryLogin">
                                
                                <p class="pass-form-item">
                                    <label class="pass-label">用户名</label>
                                    <input type="text" name="username" class="pass-text-input" placeholder="用户名">
                                </p>
                                <p class="pass-form-item">
                                    <label class="pass-label">密码</label>
                                    <input type="password" name="password" class="pass-text-input" placeholder="密码">
                                </p>
                                
                            </div>
                           
                            <div class="commonLogin">
                                <p class="pass-form-item">
                                    <input type="submit" value="登录" class="pass-button">

                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <ul class="first">
               
            </ul>
            <ul class="second">
                
                
            </ul>
        </div>
    </div>
    <script>
        $(".pass-sms-btn").click(function(){
            $(".ordinaryLogin").css({display: "none"});
            $(".messageLogin,.question").css({display: "block"});
        });
        $(".pass-sms-link").click(function(){
            $(".messageLogin,.question").css({display: "none"});
            $(".ordinaryLogin").css({display: "block"});
        });
    </script>
    <script type="text/javascript" src="/o2o/public/static/index/js/common.js"></script>
    <script type="text/javascript" src="/o2o/public/static/index/layer/layer.js"></script>
</body>
</html>