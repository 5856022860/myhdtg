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
	<span class='title'>地区列表</span>
</div>
<div id="content">
	<table id="table" class='table table-striped table-bordered'>
		<thead>
			<tr>
				<th width="5%"></th>
				<th width="25%">地区名称</th>
				<th width="10%">地区排序</th>
				<th width="10%">是否显示</th>
				<th >操作</th>
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($data)):?><?php  foreach($data as $k=>$v){ ?>
			<tr class="level_<?php echo $v['level'];?> pid_<?php echo $v['pid'];?>" cid="<?php echo $v['lid'];?>" level="<?php echo $v['level'];?>">
				<td><a class='btn btn-mini btn-info unfold' style="font-size:16px;" href="">+</a></td>
				<td>|-<?php echo $v['html'];?><?php echo $v['lname'];?></td>
				<td><?php echo $v['sort'];?></td>
				<td>
					<?php if($v['display']){?>
						显示
						<?php  }else{ ?>
						隐藏
					<?php }?>
				</td>
				<td>
					<a class='btn btn-small' href="<?php echo U('Admin/Locality/add');?>/lid/<?php echo $v['lid'];?>">添加子地区</a>
					<a class='btn btn-small' href="<?php echo U('Admin/Locality/edit');?>/lid/<?php echo $v['lid'];?>">编辑</a>
					<a class='btn btn-small delAffirm' href="<?php echo U('Admin/Locality/del');?>/lid/<?php echo $v['lid'];?>">删除</a>
				</td>
			</tr>
		<?php }?><?php endif;?>	
		</tbody>
	</table>
</div>
</body>
</html>