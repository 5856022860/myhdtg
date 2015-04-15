<?php
if (!defined("HDPHP_PATH"))exit('No direct script access allowed');
//更多配置请查看hdphp/Config/config.php
return array(
		/**************** url配置 ********************/
		"PATHINFO_HTML"    => "",     //伪静态扩展名
		
		/***************** 数据库的配置 ***************/
		"DB_DRIVER"                     => "mysqli",    //数据库驱动
		"DB_HOST"                       => "localhost", //数据库连接主机  如127.0.0.1
		"DB_PORT"                       => 3306,        //数据库连接端口
		"DB_USER"                       => "root",      //数据库用户名
		"DB_PASSWORD"                   => "",          //数据库密码
		"DB_DATABASE"                   => "hdgroup",    //数据库名称
		"DB_PREFIX"                     => "group_",     //表前缀
		"DB_FIELD_CACHE"                => 1,           //字段缓存
		"DB_BACKUP"                     => ROOT_PATH . "backup/".time(), //数据库备份目录
		/***************** 商品服务   ***************/
		'goods_server'=>array(
				1=>array(
					'name'=>'假一赔十',
					'img'=>'<span class="ico" style="background-position:0px -92px;"></span>'	
				),
				2=>array(
					'name'=>'支持随时退款',
					'img'=>'<span class="ico" style="background-position:0px 0px;"></span>'	
				),
				3=>array(
					'name'=>'7天无理由退换货',
					'img'=>'<span class="ico" style="background-position:0px -62px;"></span>'	
				),
				4=>array(
						'name'=>'不支持随时退款',
						'img'=>'<span class="ico" style="background-position:0px -121px;"></span>'
				),
				5=>array(
						'name'=>'不支持7天退换货',
						'img'=>'<span class="ico" style="background-position:0px -182px;"></span>'
				)
		),
		/*************** 文件上传的 ***************/
		"UPLOAD_PATH"                   => ROOT_PATH . "/upload/".date('Y-m',time()), //上传路径
		
		/*************** 价格配置项 ****************/
		'price'=>array(
			'all'=>array(
				array('50元以下','0-50'),
				array('100元到200','100-200'),
				array('200元到500','200-500'),
				array('500元以上','500'),
			),
			'1'=>array(
				array('50元以下','0-50'),
				array('50元到100','50-100'),
				array('100元到200','100-200'),
				array('200元以上','200'),
			),
			'6'=>array(
					array('50元以下','0-50'),
					array('50元到100','50-100'),
					array('100元到200','100-200'),
					array('200元以上','200'),
			),
			'7'=>array(
					array('50元以下','0-50'),
					array('50元到100','50-100'),
					array('100元到200','100-200'),
					array('200元以上','200'),
			),
			'8'=>array(
					array('50元以下','0-50'),
					array('50元到100','50-100'),
					array('100元到200','100-200'),
					array('200元以上','200'),
			),
			'9'=>array(
					array('50元以下','0-50'),
					array('50元到100','50-100'),
					array('100元到200','100-200'),
					array('200元以上','200')
			)
		),
		/****************** rbac ***************/
		"RBAC_AUTH_KEY"                 => "uid",      //用户SESSION名
		"COOKIE_LIFT_TIME" => 864000
);
?>
