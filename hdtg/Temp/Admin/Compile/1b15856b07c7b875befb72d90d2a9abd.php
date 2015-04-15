<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
<script type='text/javascript' src='http://example.houdunwang.com/hdzy/hdtg/group/hdphp/Extend/Org/Jquery/jquery-1.8.2.min.js'></script>
<link href="http://example.houdunwang.com/hdzy/hdtg/group/hdphp/Extend/Org/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"><script src="http://example.houdunwang.com/hdzy/hdtg/group/hdphp/Extend/Org/bootstrap/js/bootstrap.min.js"></script>
  <!--[if lte IE 6]>
  <link rel="stylesheet" type="text/css" href="http://example.houdunwang.com/hdzy/hdtg/group/hdphp/Extend/Org/bootstrap/ie6/css/bootstrap-ie6.css">
  <![endif]-->
  <!--[if lte IE 7]>
  <link rel="stylesheet" type="text/css" href="http://example.houdunwang.com/hdzy/hdtg/group/hdphp/Extend/Org/bootstrap/ie6/css/ie.css">
  <![endif]-->
<script type="text/javascript" src="http://example.houdunwang.com/hdzy/hdtg/group/hdtg/App/Admin/Tpl/Public/js/common.js"> </script>
<link href="http://example.houdunwang.com/hdzy/hdtg/group/hdtg/App/Admin/Tpl/Public/css/common.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="map">
	<span class='title'>商品列表</span>
</div>
<div id="content">
	<table id="table" class='table table-striped table-bordered'>
		<thead>
			<tr>
				<th width="15%">商铺名称</th>
				<th width="15%">商品标题</th>
				<th width="10%">商品价格</th>
				<th width="10%">商品销量</th>
				<th width="10%">所在地区</th>
				<th width="10%">所属分类</th>
				<th width="10%">下架时间</th>
				<th >操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($goods)):?><?php  foreach($goods as $v){ ?>
				<tr>
					<td><?php echo $v['shopname'];?></td>
					<td><?php echo $v['main_title'];?></td>
					<td><?php echo $v['price'];?></td>
					<td><?php echo $v['buy'];?></td>
					<td><?php echo $v['lname'];?></td>
					<td><?php echo $v['cname'];?></td>
					<td><?php echo date('Y-m-d',$v['end_time']);?></td>
					<td>
						<a class='btn btn-small' href="<?php echo U('Admin/Goods/edit');?>/gid/<?php echo $v['gid'];?>">编辑</a>
						<a class='btn btn-small delAffirm' href="<?php echo U('Admin/Goods/del');?>/gid/<?php echo $v['gid'];?>">删除</a>
					</td>
				</tr>
			<?php }?><?php endif;?>
		</tbody>
	</table>
	
	<div id="page">
		<?php echo $page;?>		
	</div>
</div>
</body>
</html>
