<?php
class LocalityControl extends CommonControl{
	
	private $lid;
	
	/**
	 * 初始化
	 */
	public function __auto(){
		$this->db = K('locality');
		$this->lid = $this->_get('lid','intval',0);
	}
	/**
	 * 显示地区
	 */
	public function index(){
		$data = $this->db->getLocalityAll();
		$data = Data::channel($data,'lid','pid',0,0,2,'--');
		$this->assign('data',$data);
		$this->display();
	}
	
	
	/**
	 * 添加地区
	 */
	public function add(){
		//如果是get请求,显示模板
		if(IS_GET === true){
			/**
			 * 分配上级地区数据
			 */
			$parent = $this->db->getParentInfo($this->lid);
			$this->assign('parent',$parent);
			//分配用于选择的数据
			$data = $this->db->getLocalityAll();
			$level = Data::channel($data,'lid','pid',0,0,2,'--');
			$this->assign('level',$level);
			//显示模板
			$this->display();
			exit;
		}
		//获取提交的数据
		$data = $this->getData();
		//完成地区的添加
		if($this->db->addLocality($data)){
			$this->success('添加成功','index');
		}else{
			throw new Exception('添加失败!');
		}
	}
	
	/**
	 * 编辑地区
	 */
	public function edit(){
		if(IS_GET === true){
			//分配用于选择的数据
			$data = $this->db->getLocalityAll();
			$level = Data::channel($data,'lid','pid',0,0,2,'--');
			$this->assign('level',$level);
			$locality  = $this->db->getLocalityFind($this->lid);
			/**
			 * 分配上级地区数据
			 */
			$parent = $this->db->getParentInfo($locality['pid']);
			$this->assign('parent',$parent);
			//分配当前地区数据
			$this->assign('locality',$locality);
			$this->display();
			exit;
		}
		$data = $this->getData();
		if($this->db->editLocality($data,$this->lid)){
			$this->success('编辑成功','index');
		}else{
			throw new Exception('编辑失败');
		}
	}
	/**
	 * 删除地区
	 */
	public function del(){
		if($this->db->checkSonLocality($this->lid)){
			$this->error('请先删除子地区','index');
		}
		if($this->db->delLocality($this->lid)){
			$this->success('删除成功','index');
		}else{
			throw new Exception('删除失败!');
		}
	}
	/**
	 * 获取地区数据
	 */
	private function getData(){
		$data = array();
		$data['lname'] = $this->_post('lname','strip_targs');
		$data['sort'] = $this->_post('sort','intval');
		$data['display'] = $this->_post('display','intval');
		$data['pid'] = $this->_post('pid','intval');
		return $data;
	}
}




















?>