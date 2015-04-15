<?php
if (!defined("HDPHP_PATH"))exit('No direct script access allowed');
//更多配置请查看hdphp/Config/config.php
return array(
		/**** 价格搜索范围   ****/
		'prices'=>array(
			'all'=>array(
				array(
					'0-50',
					'50元以下'		
				),
				array(
					'51-100',		
					'51-100元'	
				),
				array(
					'101-200',		
					'101-200元'	
				),
				array(
					'201-500',		
					'201-500元'	
				),
				array(
					'500',		
					'500元以上'	
				)
			),
			'1'=>array(
				array(
						'0-50',
						'50元以下'
				),
				array(
						'51-80',
						'51-100元'
				),
				array(
						'81-120',
						'81-120元'
				),
				array(
						'120-200',
						'120-200元'
				),
				array(
						'200',
						'200元以上'
				)
			)		
		)
		
		
		
		
		
		
		
		
);
?>