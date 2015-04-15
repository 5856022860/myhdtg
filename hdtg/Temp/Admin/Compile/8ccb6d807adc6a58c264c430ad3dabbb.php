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
<link href="http://example.houdunwang.com/hdzy/hdtg/group/hdtg/App/Admin/Tpl/Public/css/index.css" rel="stylesheet" type="text/css" />
<div id="map">
	<span class='title'>站点概况</span>
</div>
<div id="content" style="margin-left:30px; float:left;">
	<table id="table" class='table table-striped table-bordered'>
		<tbody>
			<tr>
				<th>名称</th>
				<th>值</th>
			</tr>	
			<tr>
				<td>系统信息</td>
				<td><?php echo $server['HTTP_USER_AGENT'];?></td>
			</tr>
			<tr>
				<td>WEB服务器</td>
				<td><?php echo $server['SERVER_SOFTWARE'];?></td>
			</tr>
			<tr>
				<td>服务器IP</td>
				<td><?php echo $server['SERVER_ADDR'];?></td>
			</tr>
			<tr>
				<td>端口</td>
				<td><?php echo $server['SERVER_PORT'];?></td>
			</tr>
			<tr>
				<td>当前时间</td>
				<td><?php echo date('Y-m-d H:i:s',$server['REQUEST_TIME']);?></td>
			</tr>
		</tbody>
	</table>
	
	
</div>
</body>
</html>