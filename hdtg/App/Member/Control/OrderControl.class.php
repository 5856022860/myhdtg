<?php
   class OrderControl extends CommonControl{
        public function index(){
        	 $db = K('order');
        	 $status = $this->_get('status','intval',null);
        	 if(is_null($status)){
        	 	$where = array('user_id'=>$this->uid);
        	 }else{
        	 	$where = array('user_id'=>$this->uid,'status'=>$status);
        	 }
        	 $data =  $db->getOrderData($where);//获取订单的数据        	
        	 $order = $this->disData($data);
        	 $this->assign('order', $order);
             $this->display();            
        }
        /**
         * 处理订单数据
         * @param  $data
         * @return string
         */
        private function disData($data){
        	if(!$data) return false;
        	foreach ($data as $k=> $v){
        		$pathInfo = pathinfo($v['goods_img']);
        		$data[$k]['goods_img'] = __ROOT__.'/'.$pathInfo['dirname'].'/'.$pathInfo["filename"].'_92x54.'.$pathInfo['extension'];
        		$data[$k]['zongji'] = $v['goods_num']*$v['price'];
        	}
        	return $data;
        }
        
        
        /***
         * 删除订单
         */
   		public function del(){
   			$oid = $this->_get('oid','intval',null);
   			if(is_null($oid)){
   				_404();
   			}
   			$where = array('user_id'=>$this->uid,'orderid'=>$oid);
   			$db = K('order');
   			if($db->delOrder($where)){
   				$this->success('删除成功!','index');
   			}else{
   				$this->error('删除失败！','index');
   			}
   		}  		
   }
   
   
?>