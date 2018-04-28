<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"/Users/lanlee/Sites/o2o/public/../application/admin/view/deal/index.html";i:1524333011;s:65:"/Users/lanlee/Sites/o2o/application/admin/view/public/header.html";i:1524387529;s:65:"/Users/lanlee/Sites/o2o/application/admin/view/public/footer.html";i:1524389074;}*/ ?>
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
<script type="text/javascript" src="/o2o/public/static/admin/hui/lib/html5.js"></script>
<script type="text/javascript" src="/o2o/public/static/admin/hui/lib/respond.min.js"></script>
<script type="text/javascript" src="/o2o/public/static/admin/hui/lib/PIE_IE678.js"></script>
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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 团购商品列表 </nav>
<div class="page-container">
<div class="cl pd-5 bg-1 bk-gray mt-20"> 
	<div class="text-c">
		<form method="get" action="<?php echo url('deal/index'); ?>">
		 <span class="select-box inline">
			<select name="category_id" class="select">
				<option value="0">全部分类</option>
				<?php if(is_array($categorys) || $categorys instanceof \think\Collection || $categorys instanceof \think\Paginator): $i = 0; $__LIST__ = $categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<option value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == $category_id): ?>selected="selected"<?php endif; ?>><?php echo $vo['name']; ?></option>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		</span>
		<span class="select-box inline">
			<select name="city_id" class="select cityId">
					<option value="0">--请选择--</option>
					<?php if(is_array($citys) || $citys instanceof \think\Collection || $citys instanceof \think\Paginator): $i = 0; $__LIST__ = $citys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<option value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == $city_id): ?>selected="selected"<?php endif; ?>><?php echo $vo['name']; ?></option>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</span>
		<span class="select-box inline">
			<select name="se_city_id" class="select se_city_id" id="showCity">
				<?php if(($se_city== '')): ?>
				<option value="0">--请选择--</option>
				<?php else: if(is_array($se_city) || $se_city instanceof \think\Collection || $se_city instanceof \think\Paginator): $i = 0; $__LIST__ = $se_city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<option value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == $se_city_id): ?>selected="selected"<?php endif; ?>><?php echo $vo['name']; ?></option>
				<?php endforeach; endif; else: echo "" ;endif; endif; ?>
				</select>
		</span> 日期范围：
		<input type="text" name="start_time" class="input-text" id="start_time" onfocus="selecttime(1)" value="<?php echo $start_time; ?>" style="width:120px;" >
			-
		<input type="text" name="end_time" class="input-text" id="end_time" onfocus="selecttime(1)" value="<?php echo $end_time; ?>"  style="width:120px;">
		<input type="text"  name="name" id="" placeholder=" 商品名称" style="width:150px" class="input-text" value="<?php echo $name; ?>">
		<button name="" id="searchDeal" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索
		</button>
			<a href="<?php echo url('deal/index'); ?>" class="btn " type="reset"><i class="Hui-iconfont">&#xe665;</i> 重置
			</a>
		</form>

	</div>
</div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="20">ID</th>
					<th width="100">商品名称</th>
					<th width="40">分类</th>
					<th width="40">城市</th>
					<th width="40">购买件数</th>
					<th width="80">开始结束时间</th>
					<th width="80">创建时间</th>
					<th width="60">状态</th>
					<th width="40">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($deals) || $deals instanceof \think\Collection || $deals instanceof \think\Paginator): $i = 0; $__LIST__ = $deals;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<tr class="text-c">
					<td><?php echo $vo['id']; ?></td>
					<td><?php echo $vo['name']; ?></td>
					<td><?php echo getCategoryName($vo['category_id']); ?></td>
					<td><?php echo getCityName($vo['city_path']); ?></td>
					<td><?php echo $vo['buy_count']; ?></td>
					<td><?php echo date('Y-m-d H:i',$vo['start_time']); ?><br><?php echo date('Y-m-d H:i',$vo['end_time']); ?></td>
					<td><?php echo $vo['create_time']; ?></td>
					<td><?php echo dealstatus($vo['status']); ?></td>
					<td class="td-manage">
						<a style="text-decoration:none" class="ml-5" onClick="" href="<?php echo url('deal/detail',['id'=>$vo['id']]); ?>" title="查看" target="_blank"><i class="Hui-iconfont">&#xe6df;</i></a>
						<?php if($vo['status'] == 1): ?>
						<a style="text-decoration:none" class="ml-5" onClick="o2o_del('<?php echo url('deal/status',['id'=>$vo['id'],'status'=>-1]); ?>','确认要下架吗？')" href="javascript:;" title="下架"><i class="Hui-iconfont">下架</i></a>
						<?php endif; ?>
					</td>
				</tr>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
	</div>
	<?php echo pagination($deals); ?>
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
<script>
    var SCOPE = {
        'city_url':'<?php echo url("api/city/getCityByParentId"); ?>',
        'category_url': '<?php echo url("api/category/getCategoryByParentId"); ?>',
        'uploadify_swf' : '/o2o/public/static/admin/uploadify/uploadify.swf',
        'image_upload' :'<?php echo url("api/image/upload"); ?>',
        'featured_url':'<?php echo url("featured/add"); ?>',
    }
</script>

<script type="text/javascript" src="/o2o/public/static/admin/js/common.js"></script>
<script type="text/javascript" src="/o2o/public/static/admin/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="/o2o/public/static/admin/js/image.js"></script>

<script src="/o2o/public/static/admin/hui/lib/My97DatePicker/WdatePicker.js"></script>
