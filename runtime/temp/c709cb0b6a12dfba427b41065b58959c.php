<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:73:"/Users/lanlee/Sites/o2o/public/../application/index/view/index/index.html";i:1524923684;s:65:"/Users/lanlee/Sites/o2o/application/index/view/public/header.html";i:1524923684;s:62:"/Users/lanlee/Sites/o2o/application/index/view/public/nav.html";i:1524923684;}*/ ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="/o2o/public/static/index/css/base.css" />
    <link rel="stylesheet" href="/o2o/public/static/index/css/common.css" />
    <link rel="stylesheet" href="/o2o/public/static/index/css/<?php echo $controller; ?>.css" />
    <script type="text/javascript" src="/o2o/public/static/index/js/html5shiv.js"></script>
    <script type="text/javascript" src="/o2o/public/static/index/js/respond.min.js"></script>
    <script type="text/javascript" src="/o2o/public/static/index/js/jquery-1.11.3.min.js"></script>
</head>
<body>
<div class="header-bar">
    <div class="header-inner">
        <ul class="father">
            <li><a><?php echo $city['name']; ?></a></li>
            <li>|</li>
            <li class="city">
                <a>切换城市<span class="arrow-down-logo"></span></a>
                <div class="city-drop-down">
                    <h3>热门城市</h3>
                    <ul class="son">
                        <?php if(is_array($citys) || $citys instanceof \think\Collection || $citys instanceof \think\Paginator): $i = 0; $__LIST__ = $citys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo url('index/index',['city'=>$vo['name']]); ?>"><?php echo $vo['name']; ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>

                </div>
            </li>
            <li><a href="<?php echo url('bis/login/index'); ?>">商家入口</a></li>
            <?php if($user): ?>
            <li><a href="<?php echo url('user/loginout'); ?>">退出</a></li>
            <li>欢迎您：<?php echo $user['username']; ?></li>
            <?php else: ?>
            <li><a href="<?php echo url('user/register'); ?>">注册</a></li>
            <li><a href="<?php echo url('user/login'); ?>">登录</a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>
<div class="search">
    <a href="<?php echo url('index/index'); ?>"><img src="/o2o/public/static/index/image/logo.png" /></a>

</div>

<div class="nav-bar-header">
    <div class="nav-inner">
        <ul class="nav-list">
            <li class="nav-item">
                <span class="item">全部分类</span>
                <div class="left-menu">

                    <?php if(is_array($cats) || $cats instanceof \think\Collection || $cats instanceof \think\Paginator): $i = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($i % 2 );++$i;?>
                    <div class="level-item">
                        <div class="first-level">
                            <dl>
                                <dt class="title"><a href="<?php echo url('lists/index',['id'=>$key]); ?>" target="_blank"><?php echo $cat['name']; ?></a></dt>
                                <?php if(is_array($cat[0]) || $cat[0] instanceof \think\Collection || $cat[0] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($cat[0]) ? array_slice($cat[0],0,2, true) : $cat[0]->slice(0,2, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <dd><a href="<?php echo url('lists/index',['id'=>$vo['id']]); ?>" target="_blank" class="" ><?php echo $vo['name']; ?></a></dd>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </dl>
                        </div>
                        <div class="second-level">
                            <div class="section">
                                <div class="section-item clearfix no-top-border">
                                    <h3>热门分类</h3>
                                    <ul>
                                        <?php if(is_array($cat[0]) || $cat[0] instanceof \think\Collection || $cat[0] instanceof \think\Paginator): $i = 0; $__LIST__ = $cat[0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <li><a href="<?php echo url('lists/index',['id'=>$vo['id']]); ?>" target="_blank"><?php echo $vo['name']; ?></a></li>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </li>
            <li class="nav-item"><a href="<?php echo url('index/index'); ?>" class="item first active">首页</a></li>
            <li class="nav-item"><a class="item">团购</a></li>
            <li class="nav-item"><a class="item">商户</a></li>
        </ul>
    </div>
</div>

    <div class="container">
        <div class="top-container">
            <div class="mid-area">

                <div class="slide-holder" id="slide-holder">
                    <a href="#" class="slide-prev"><i class="slide-arrow-left"></i></a>
                    <a href="#" class="slide-next"><i class="slide-arrow-right"></i></a>

                    <ul class="slideshow">
                        <?php if(is_array($center) || $center instanceof \think\Collection || $center instanceof \think\Paginator): $i = 0; $__LIST__ = $center;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo $vo['url']; ?>" class="item-large"  title="<?php echo $vo['title']; ?>"><img class="ad-pic" src="<?php echo $vo['image']; ?>" /></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>

                <div class="list-container">
                </div>
            </div>
        </div>
        <div class="right-sidebar">
            <div class="right-ad">
                <ul class="slidepic">
                    <?php if(is_array($right) || $right instanceof \think\Collection || $right instanceof \think\Paginator): $i = 0; $__LIST__ = $right;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li><a  href="<?php echo $vo['url']; ?>" title="<?php echo $vo['title']; ?>"><img src="<?php echo $vo['image']; ?>" /></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
        <div class="content-container">
            <div class="no-recom-container">
                <div class="floor-content-start">
                    
                    <div class="floor-content">
                        <div class="floor-header">
                            <h3>美食</h3>
                            <ul class="reco-words">
                                <?php if(is_array($meishiCat) || $meishiCat instanceof \think\Collection || $meishiCat instanceof \think\Paginator): $i = 0; $__LIST__ = $meishiCat;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <li><a href="<?php echo url('lists/index',['id'=>$vo['id']]); ?>" target="_blank"><?php echo $vo['name']; ?></a></li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                <li><a class="no-right-border no-right-padding" href="<?php echo url('lists/index'); ?>" target="_blank">全部<span class="all-cate-arrow"></span></a></li>
                            </ul>
                        </div>
                        <ul class="itemlist eight-row-height">
                            <?php if(is_array($meishiDeal) || $meishiDeal instanceof \think\Collection || $meishiDeal instanceof \think\Paginator): $i = 0; $__LIST__ = $meishiDeal;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li class="j-card">
                                <a href="<?php echo url('detail/index',['id'=>$vo['id']]); ?>" target="_blank">
                                    <div class="imgbox">
                                        <ul class="marketing-label-container">
                                            <li class="marketing-label marketing-free-appoint"></li>
                                        </ul>
                                        <div class="range-area">
                                            <div class="range-bg"></div>
                                            <div class="range-inner">
                                                <span class="white-locate"></span>
                                                <?php echo getLocationName($vo['location_ids']); ?>
                                            </div>
                                        </div>
                                        <div class="borderbox">
                                            <img src="<?php echo $vo['image']; ?>" />
                                        </div>
                                    </div>
                                </a>
                                <div class="contentbox">
                                    <a href="<?php echo url('detail/index',['id'=>$vo['id']]); ?>" target="_blank">
                                        <div class="header">
                                            <h4 class="title ">【<?php echo getLocationCount($vo['location_ids']); ?>店通用】<?php echo getBisNameById($vo['bis_id']); ?></h4>
                                        </div>
                                        <p><?php echo $vo['name']; ?></p>
                                    </a>
                                    <div class="add-info">
                                        <span class="promo">立减<?php echo $vo['origin_price']-$vo['current_price']; ?>元</span>
                                    </div>
                                    <div class="pinfo">
                                        <span class="price"><span class="moneyico">¥</span><?php echo $vo['current_price']; ?></span>
                                        <span class="ori-price">价值<span class="price-line">¥<span><?php echo $vo['origin_price']; ?></span></span></span>
                                    </div>
                                    <div class="footer">
                                        <span class="sold">已售<?php echo $vo['buy_count']; ?></span>
                                        <div class="bottom-border"></div>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="footer-content">
        <div class="copyright-info">
            
        </div>
    </div>

    <script>
        var width = 800 * $("#slide-holder ul li").length;
        $("#slide-holder ul").css({width: width + "px"});

        //轮播图自动轮播
        var time = setInterval(moveleft,5000);

        //轮播图左移
        function moveleft(){
            $("#slide-holder ul").animate({marginLeft: "-737px"},600, function () {
                $("#slide-holder ul li").eq(0).appendTo($("#slide-holder ul"));
                $("#slide-holder ul").css("marginLeft","0px");
            });
        }

        //轮播图右移
        function moveright(){
            $("#slide-holder ul").css({marginLeft: "-737px"});
            $("#slide-holder ul li").eq(($("#slide-holder ul li").length)-1).prependTo($("#slide-holder ul"));
            $("#slide-holder ul").animate({marginLeft: "0px"},600);
        }

        //右滑箭头点击事件
        $(".slide-next").click(function () {
            clearInterval(time);
            moveright();
            time = setInterval(moveleft,5000);
        });

        //左滑箭头点击事件
        $(".slide-prev").click(function () {
            clearInterval(time);
            moveleft();
            time = setInterval(moveleft,5000);
        });
    </script>
</body>
</html>