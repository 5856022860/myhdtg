<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?>	<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
	<link href="http://example.houdunwang.com/hdzy/hdtg/group/hdtg/App/Member/Tpl/Public/css/reg.css" type="text/css" rel="stylesheet" >
	<script src="http://example.houdunwang.com/hdzy/hdtg/group/hdtg/App/Member/Tpl/Public/js/regCheck.js"></script> 
	<script>
		function changeCode(){
			var src = '<?php echo U('Member/Reg/showCode');?>/mt/'+Math.random();
			$(this).attr('src',src);
		}
		var __JSCONTROL__ = 'http://example.houdunwang.com/hdzy/hdtg/group/index.php/Member/Reg';
	</script>
	
	<div id="regBox">
		<div class='header'>
			已有本站账号?<a href="">登录</a>
		</div>
		<div class='form'>
		<form action="<?php echo U('Member/Reg/addUser');?>" method="post" id="regForm">
			<dl class='focus'>
				<dt>邮箱</dt>
				<dd class='text'><input class='must' type="text" ajax=1   name="email" /></dd>
				<dd class='prompt'>用于登录和找回密码，不会公开</dd>
			</dl>
			<dl>
				<dt>用户名</dt>
				<dd class='text'><input class='must' type="text"  ajax=1   name="username" /></dd>
				<dd class='prompt'></dd>
			</dl>
			<dl>
				<dt>创建密码</dt>
				<dd class='text'><input class='must' id="password" type="password" name="password"/></dd>
				<dd class='prompt'></dd>
			</dl>
			<dl>
				<dt>确认密码</dt>
				<dd class='text'><input class='must' type="password" name="password_d"/></dd>
				<dd class='prompt'></dd>
			</dl>
			<dl>
				<dt>验证码</dt>
				<dd class='text code' style="width:200px;"><input ajax=1  style="float:left;" class='must' type="text"  name="code"/><img onclick="changeCode.call(this);" style="float:left;margin:0px 10px; width:80px;height:28px;" src="<?php echo U('Member/Reg/showCode');?>"></dd>
				<dd class='prompt'></dd>
			</dl>
			<dl>
				<dt></dt>
				<dd class='submit'><input type="submit" value="注册"></dd>
			</dl>
		</form>
		</div>
	</div>
</body>
</html>