<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"/Users/lanlee/Sites/o2o/public/../application/bis/view/login/index.html";i:1524150841;s:63:"/Users/lanlee/Sites/o2o/application/bis/view/public/header.html";i:1524035969;s:63:"/Users/lanlee/Sites/o2o/application/bis/view/public/footer.html";i:1524388046;}*/ ?>
<!--包含头部文件-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<LINK rel="Bookmark" href="/favicon.ico" >
<LINK rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<script type="text/javascript" src="lib/PIE_IE678.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/o2o/public/static/admin/hui/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/o2o/public/static/admin/hui/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/o2o/public/static/admin/hui/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/o2o/public/static/admin/hui/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="/o2o/public/static/admin/hui/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/o2o/public/static/admin/hui/static/h-ui.admin/css/style.css" />
  <link rel="stylesheet" type="text/css" href="/o2o/public/static/admin/css/common.css" />
  <link rel="stylesheet" type="text/css" href="/o2o/public/static/admin/uploadify/uploadify.css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>o2o平台</title>
<meta name="keywords" content="tp5打造o2o平台系统">
<meta name="description" content="o2o平台">
</head>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"><h1 style="text-align:center">商户登录系统</h1></div>
<div class="loginWraper">

  <div id="loginform" class="loginBox">

    <form class="form form-horizontal" action="<?php echo url('login/index'); ?>" method="post">
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-6">
          <input id="username" name="username" type="text" placeholder="账户" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-6">
          <input id="password" name="password" type="password" placeholder="密码" class="input-text size-L">
        </div>
      </div>
      
      
      <div class="row cl">

        <div class="formControls col-xs-8 col-xs-offset-3">

          <input name=""  type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
          <a href="<?php echo url('register/index'); ?>"><input name="" type="" class="btn btn-success radius size-L" value="&nbsp;申请&nbsp;&nbsp;&nbsp;&nbsp;入驻&nbsp;"></a>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="footer">Copyright tp5打造本地生活服务系统</div>
<!--包含尾部文件-->
<script type="text/javascript" src="/o2o/public/static/admin/hui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/o2o/public/static/admin/hui/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/o2o/public/static/admin/hui/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/o2o/public/static/admin/hui/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script> 
<script type="text/javascript" src="/o2o/public/static/admin/hui/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/o2o/public/static/admin/hui/lib/jquery.validation/1.14.0/messages_zh.min.js"></script>  
<script type="text/javascript" src="/o2o/public/static/admin/hui/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/o2o/public/static/admin/hui/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type = “text/javascript” src = “http://code.jquery.com/jquery-1.7.2.min.js” > </script>
<script>
    var SCOPE = {
        'city_url':'<?php echo url("api/city/getCityByParentId"); ?>',
        'category_url': '<?php echo url("api/category/getCategoryByParentId"); ?>',
        'uploadify_swf' : '/o2o/public/static/admin/uploadify/uploadify.swf',
        'image_upload' :'<?php echo url("api/image/upload"); ?>',
        'register_url' : '<?php echo url("register/add"); ?>',
        'maptag_url':'<?php echo url("register/maptag"); ?>',
        'waiting_url' :'<?php echo url("register/waiting"); ?>',
        'location_url':'<?php echo url("location/add"); ?>',
        'city_location' : '<?php echo url("api/location/getLocationByCityPath"); ?>',
        'deal_url' :'<?php echo url("deal/add"); ?>',

    }
</script>
<script type="text/javascript" src="/o2o/public/static/admin/js/common.js"></script>
<script type="text/javascript" src="/o2o/public/static/admin/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="/o2o/public/static/admin/js/image.js"></script>
