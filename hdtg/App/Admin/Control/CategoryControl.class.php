<?php
class CategoryControl extends CommonControl{
	
	private $cid;	//分类id
	
	public function __auto(){
		//实例模型
		$this->db = K('category');
		//接受cid
		$this->cid = $this->_get('cid','intval',0);
	}
	/**
	 * 显示分类列表
	 */
	public function index(){
		$category = $this->db->getCategoryAll();
		$data = Data::channel($category,'cid','pid',0,0,2,'--');
		$this->assign('data',$data);
		$this->display();
	}
	/**
	 * 添加分类的方法
	 */
	public function add(){
		//是get请求显示模板
		if(IS_GET === true){
			//查询父类信息
			$parent = $this->db->getParentInfo($this->cid);
			$this->assign('parent',$parent);
			//获取所有的分类，用于选择
			$data = $this->db->getCategoryAll();
			$level = Data::channel($data,'cid','pid',0,0,2,'--');
			$this->assign('level',$level);
			//显示模板
			$this->display();
			exit;
		}
		//获得分类的数据
		$data = $this->getData();
		//添加分类
		if($this->db->addCategory($data)){
			//成功后跳转，显示分类列表
			$this->success('添加成功',U('Admin/Category/index'));
		}else{
			throw new Exception('添加分类失败!');
		}
	}
	/**
	 * 编辑分类 
	 */
	public function edit(){
		if(IS_GET === true){
			//获取所有的分类，用于选择
			$data = $this->db->getCategoryAll();
			$level = Data::channel($data,'cid','pid',0,0,2,'--');
			$this->assign('level', $level);
			$category = $this->db->getCategoryFind($this->cid);
			//查询父类信息
			$parent = $this->db->getParentInfo($category['pid']);
			$this->assign('parent',$parent);
			$this->assign('category',$category);
			$this->display();
			exit;
		}
		$data = $this->getData();
		if($this->db->editCategory($data,$this->cid)){
			$this->success('编辑成功',U('Admin/Category/index'));
		}else{
			throw new Exception('编辑失败');
		}
	}
	/**
	 * 删除分类
	 */
	public function del(){
		//$this->cid
		if($this->db->checkSonCategory($this->cid)){
			$this->error('请先删除子分类');
		}
		if($this->db->delCategory($this->cid)){
			$this->success('删除成功','index');
		}else{
			throw new Exception('删除失败!');
		}
	}
	/**
	 * 处理提交的数据
	 */
	private function getData(){
		$data = array();
		$data['cname'] = $this->_post('cname','strip_tags');
		$data['title'] = $this->_post('title','htmlspecialchars');
		$data['keywords'] = $this->_post('keywords','htmlspecialchars');
		$data['description'] = $this->_post('description','htmlspecialchars');
		$data['sort'] = $this->_post('sort','intval');
		$data['display'] = $this->_post('display','intval');
		$data['pid'] = $this->_post('pid','intval');
		return $data;
	}
}
?>