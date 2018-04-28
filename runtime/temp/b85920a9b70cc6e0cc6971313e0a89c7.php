<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"/Users/lanlee/Sites/o2o/public/../application/bis/view/deal/edit.html";i:1524655474;s:63:"/Users/lanlee/Sites/o2o/application/bis/view/public/header.html";i:1524035969;s:63:"/Users/lanlee/Sites/o2o/application/bis/view/public/footer.html";i:1524388046;}*/ ?>
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
<body>
<div class="page-container">
	<form class="form form-horizontal form-o2o-add" id="form-o2o-add" method="post" action="<?php echo url('deal/save'); ?>">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">团购开始时间：</label>
			<div class="formControls col-xs-8 col-sm-3">

				<input type="text" name="start_time" class="input-text" id="countTimestart" onfocus="selecttime(1)" value=""  >

			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">团购结束时间:</label>
			<div class="formControls col-xs-8 col-sm-3">

				<input type="text" name="end_time" class="input-text" id="countTimeend" onfocus="selecttime(1)" value=""  >
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">消费券生效时间：</label>
			<div class="formControls col-xs-8 col-sm-3">

				<input type="text" name="coupons_begin_time" class="input-text" id="countTimestart" onfocus="selecttime(1)" value=""  >
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">消费券结束时间:</label>
			<div class="formControls col-xs-8 col-sm-3">

				<input type="text" name="coupons_end_time" class="input-text" id="countTimeend" onfocus="selecttime(1)" value=""  >
			</div>
		</div>


		
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button  type="submit" class="btn btn-primary radius" ><i class="Hui-iconfont">&#xe632;</i> 保存</button>
				
				<a href="<?php echo url('deal/index'); ?>" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</a>
			</div>
		</div>
		<input type="hidden" name="id" value="<?php echo $id; ?>">
	</form>
</div>
</div>
<!--包含头部文件-->
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

</body>
</html>
