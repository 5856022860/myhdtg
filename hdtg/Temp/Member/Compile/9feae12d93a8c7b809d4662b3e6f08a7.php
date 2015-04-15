<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="http://example.houdunwang.com/hdzy/hdtg/group/Public/css/reset.css" type="text/css" rel="stylesheet" >
<link href="http://example.houdunwang.com/hdzy/hdtg/group/Public/css/common.css" type="text/css" rel="stylesheet" >
<script type='text/javascript' src='http://example.houdunwang.com/hdzy/hdtg/group/hdphp/Extend/Org/Jquery/jquery-1.8.2.min.js'></script>
<script type="text/javascript" src="http://example.houdunwang.com/hdzy/hdtg/group/Public/js/common.js"></script>
<meta name="keywords" content="" />
<meta name="description" content="" />
<title><?php echo $webInfo['title'];?></title>

</head>
<body>
	<!-- 顶部开始 -->
	<div id="top">
		<div class='position'>
			<div class='left'>
				后盾网，人人做后盾!
			</div>
			<div class='right'>
				<a href="javascript:addFavorite2();">收藏</a>
			</div>
		</div>
	</div>
	<!-- 顶部结束 -->
	<!-- 头部开始 -->
	<div id="header">
		<div class='position'>
			<div class='logo'>
				<a style="line-height:60px;" href="http://example.houdunwang.com/hdzy/hdtg/group">后盾团购</a>
				<a style="font-size:16px;" href="http://example.houdunwang.com/hdzy/hdtg/group">www.houdunwang.com</a>
			</div>
			<div class='search'>
				<div class='item'>
					<a href="<?php echo U('Index/Index/index');?>/keywords/小时代">小时代</a>
					<a href="<?php echo U('Index/Index/index');?>/keywords/KTV">KTV</a>
					<a href="<?php echo U('Index/Index/index');?>/keywords/电影">电影</a>
					<a href="<?php echo U('Index/Index/index');?>/keywords/全聚德">全聚德</a>
				</div>
				<div class='search-bar'>
					<form action="<?php echo U('Index/Index/index');?>" method="get">
						<input class='s-text' type="text" name="keywords" value="请输入商品名称，地址等">
						<input class='s-submit' type="submit" value='搜索'>
					</form>
				</div>
			</div>
			<div class='commitment'>
				
			</div>
		</div>
	</div>
	<!-- 头部结束 -->
	<!-- 导航开始-->
	<div id="nav">
		<div class='position'>
			<!-- 分类相关 -->
			<div class='category'>
				<a category=-1  href="http://example.houdunwang.com/hdzy/hdtg/group">首页</a>
				<?php if(is_array($nav)):?><?php  foreach($nav as $k=>$v){ ?>
					<a category=<?php echo $k;?> href="<?php echo U('Index/Index/index');?>/cid/<?php echo $v['cid'];?>"><?php echo $v['cname'];?></a>
				<?php }?><?php endif;?>
			</div>
			<script>
				
				/**
				* 获取cookie
				* @param name
				* @returns
				*/
				function getCookie(name){
					var arr = document.cookie.split(';');
					for(var i=0;i<arr.length;i++){
						var	arr2 = arr[i].split('=');
						var preg = new RegExp('\\b'+name+'\\b','i')
						if(preg.test(arr2[0])){
							return	arr2[1];
						}
					}
				}
				$('.category a').click(function(){
					var category = $(this).attr('category');
					document.cookie = "category="+category+';path=/';
				})
				var category = getCookie('category');
				$('.category a').each(function(){
					if($(this).attr('category') == category){
						$(this).addClass('active');
					}else{
						$(this).removeClass('active');
					}
				})
			</script>
			<!-- 用户相关 -->
			<div id="user-relevance" class='user-relevance'>
				<?php if($userIsLogin){?>
					<div class='user-nav login-reg'>
						<a class='title' href="<?php echo U('Member/Login/quit');?>">退出</a>
					</div>
					<!--我的团购 -->	
					<div class='user-nav my-hdtg '>
						<a class='title' href="<?php echo U('Member/Order/index');?>">我的团购</a>
						<ul class="menu">
							<li><a href="<?php echo U('Member/Order/index');?>">我的订单</a></li>	
							<li><a href="<?php echo U('Member/Index/collect');?>">我的收藏</a></li>
							<li><a href="<?php echo U('Member/Account/index');?>">账户余额</a></li>
							<li><a href="<?php echo U('Member/Account/setting');?>">账户设置</a></li>
						</ul>
					</div>
				<?php  }else{ ?>	
					<!--登录注册-->
					<div class='user-nav login-reg'>
						<a class='title' href="<?php echo U('Member/Reg/index');?>">注册</a>
					</div>
					<div class='user-nav login-reg'>	
						<a class='title' href="<?php echo U('Member/Login/index');?>">登录</a>
					</div>
				<?php }?>
					<!-- 最近浏览 -->	
					<div  class='user-nav recent-view ' url="<?php echo U('Member/Index/getRecentView');?>" goodUrl ="<?php echo U('Index/Detail/index');?>" clearView="<?php echo U('Member/Index/clearRecentView');?>">
						<a class='title' href="">最近浏览</a>
						<ul class="menu">
							
							
						</ul>
					</div>
					<!-- 购物车 -->
					<div  class='user-nav my-cart ' id="my-cart" url="<?php echo U('Member/Cart/index');?>" goodUrl ="<?php echo U('Index/Detail/index');?>" delCartUrl ="<?php echo U('Member/Cart/del');?>">
						<a class='title' href="<?php echo U('Member/Cart/index');?>"><i>&nbsp;</i>购物车</a>
						<ul class="menu">
							<p>正在加载..</p>
						</ul>
					</div>
			</div>
		</div>
	</div> 
	<!-- 导航结束 -->
	<!-- 载入公共头部文件-->
<link href="http://example.houdunwang.com/hdzy/hdtg/group/hdtg/App/Member/Tpl/Public/css/userhome.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" src="http://example.houdunwang.com/hdzy/hdtg/group/hdtg/App/Member/Tpl/Public/js/userhome.js"></script>	
<div id="main">
	<div class='left'>
		<ul class='userhome-nav'>
			<li class='active' id="1">
				<a href="<?php echo U('Member/Order/index');?>">团购订单</a>
			</li>
			<li id="2">
				<a href="<?php echo U('Member/Index/collect');?>">我的收藏</a>
			</li>
			<li id="3">
				<a href="<?php echo U('Member/Account/index');?>">美团余额</a>
			</li>
			<li id="4">
				<a href="<?php echo U('Member/Account/setting');?>">账户设置</a>
			</li>
		</ul>
		<script>
				
				/**
				* 获取cookie
				* @param name
				* @returns
				*/
				function getCookie(name){
					var arr = document.cookie.split(';');
					for(var i=0;i<arr.length;i++){
						var	arr2 = arr[i].split('=');
						var preg = new RegExp('\\b'+name+'\\b','i')
						if(preg.test(arr2[0])){
							return	arr2[1];
						}
					}
				}
				$('.userhome-nav li').click(function(){
					var id = $(this).attr('id');
					document.cookie = "userHomeNav="+id+';path=/';
				})
				var id = getCookie('userHomeNav');
				$('.userhome-nav li').each(function(){
					if($(this).attr('id') == id){
						$(this).addClass('active');
					}else{
						$(this).removeClass('active');
					}
				})
			</script>
		<div id="content">
		<link href="http://example.houdunwang.com/hdzy/hdtg/group/hdtg/App/Member/Tpl/Public/css/account.css" type="text/css" rel="stylesheet" >
		<div class='setting-nav'>
			<a href="">基本信息</a>
			<a class='active' href="">收货地址</a>
		</div>
		<div class='address-list'>
			<table>
				<thead>
					<tr>
						<th width="20%">收货人</th>
						<th>地址/邮编</th>
						<th width="20%">电话/手机</th>
						<th width="20%">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($address)):?><?php  foreach($address as $v){ ?>
					<tr>
						<td>
							<?php echo $v['consignee'];?>
						</td>
						<td>
						<?php echo $v['province'];?>-<?php echo $v['city'];?>-<?php echo $v['county'];?>-<?php echo $v['street'];?>
						</td>
						<td>
							<?php echo $v['tel'];?>
						</td>
						<td>
							<a href="<?php echo U('Member/Account/delAddress');?>/addressid/<?php echo $v['addressid'];?>">删除</a>
						</td>
					</tr>
					<?php }?><?php endif;?>
				</tbody>
			</table>	
		</div>
		<!-- 收货地址 -->
		<div id="addressForm" class="address">
			<form action="<?php echo U('Member/Account/addAddress');?>" method="post">
			<div class='address-base'>
				<dl>
					<dt>*省市区：</dt>
					<dd style="width:400px;">
						<select id="s_province" name="province"></select>
						<select id="s_city" name="city" ></select>
						<select id="s_county" name="county"></select>
						<script type="text/javascript" src="http://example.houdunwang.com/hdzy/hdtg/group/classLibs/area/area.js"></script>
						<script type="text/javascript">_init_area();</script>
					</dd>
				</dl>
				<dl>
					<dt>*街道地址：</dt>
					<dd style="width:450px;">
						<input name="street" type="text" value="">
					</dd>
				</dl>
				<dl>
					<dt>*邮政编码：</dt>
					<dd>
						<input name="postcode" type="text" value="">
					</dd>
				</dl>
				<dl>
					<dt>*收货人姓名：</dt>
					<dd>
						<input name="consignee" type="text" value="">
					</dd>
				</dl>
				<dl>
					<dt>*电话号码：</dt>
					<dd>
						<input type="text" name="tel" value=""> 
					</dd>
				</dl>
				<dl>
					<dt></dt>
					<dd>
						<input type="submit" value="提交"> 
					</dd>
				</dl>
			</div>
			</form>
		</div>	
<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?>			</div>
		</div>
	</div>
</body>
</html>