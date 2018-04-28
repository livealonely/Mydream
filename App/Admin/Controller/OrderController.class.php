<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;
class OrderController extends CommonController{
	public function OrderList($page = 1, $rows = 10, $sort = 'memberid', $order = 'asc'){
		if(IS_POST){
			$admin_db = D('member');
			$total = $admin_db->count();
			$order = $sort.' '.$order;
			$limit = ($page - 1) * $rows . "," . $rows;
			$list = $admin_db->table(C('DB_PREFIX').'member A')->join(C('DB_PREFIX').'member_role AR on AR.m_roleid = A.department')->field("A.memberid ,A.username,AR.rolename,A.job,A.QQ,A.phone")->order($order)->limit($limit)->select();
			$data = array('total'=>$total, 'rows'=>$list);
			$this->ajaxReturn($data);
		}else{
			$menu_db = D('menu');
			$currentpos = $menu_db->currentPos(I('get.menuid'));  //栏目位置
			$datagrid = array(
		        'options'     => array(
    				'title'   => $currentpos,
    				'url'     => U('Member/memberList', array('grid'=>'datagrid')),
    				'toolbar' => 'Member_memberlist_datagrid_toolbar',
    			),
		        'fields' => array(
		        	
		        	'姓名'      => array('field'=>'username','width'=>15,'sortable'=>true),
		        	'部门'      => array('field'=>'rolename','width'=>10,'sortable'=>true),
		        	'职位'      => array('field'=>'job','width'=>10,'sortable'=>true),
		        	'电话'      => array('field'=>'phone','width'=>10,'sortable'=>true),
		        	'QQ'      => array('field'=>'QQ','width'=>10,'sortable'=>true),
		        	'管理操作'    => array('field'=>'memberid','width'=>15,'formatter'=>'adminMemberListOperateFormatter'),


    			)
		    );
		    $this->assign('datagrid', $datagrid);
		    $this->display('order_list');
		}
	}

	public function memberAdd(){
		if(IS_POST){
			$admin_db = D('order');
			$data = I('post.info');
			// if($admin_db->where(array('username'=>$data['username']))->field('username')->find()){
			// 	$this->error('员工已经存在');
			// }

    		$id = $admin_db->add($data);	
    		if($id){
    			$this->success('添加成功');
    		}else {
    			$this->error('添加失败');
    		}
		}else{
			$admin_role_db = D('MemberRole');
			$rolelist = $admin_role_db->where(array('disabled'=>'0'))->getField('m_roleid,rolename', true);
			$this->assign('rolelist', $rolelist);
			$this->display('order_add');
		}
	}

}
