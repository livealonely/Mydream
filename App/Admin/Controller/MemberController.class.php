<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;

/**
 * 空模块，主要用于显示404页面，请不要删除
 * @author wangdong
 */
class MemberController extends CommonController{

	public function memberList($page = 1, $rows = 10, $sort = 'memberid', $order = 'asc'){
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
		    $this->display('member_list');
		}
	}

	public function memberAdd(){
		if(IS_POST){
			$admin_db = D('member');
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
			$this->display('member_add');
		}
	}

	public function memberDelete($id){
		if($id == '1') $this->error('该用户不能被删除');
		$admin_db = D('Member');
		$result = $admin_db->where(array('memberid'=>$id))->delete();
		if ($result){
			$this->success('删除成功');
		}else {
			$this->error('删除失败');
		}
	}

	public function memberEdit($id){
		$admin_db = D('Member');
		if(IS_POST){
			if($id == '1') $this->error('该用户不能被修改');
			$data = I('post.info');
			// if($data['password']){
			// 	$passwordinfo = password($data['password']);
			// 	$data['password'] = $passwordinfo['password'];
			// 	$data['encrypt'] = $passwordinfo['encrypt'];
			// }else{
			// 	unset($data['password']);
			// }
    		$result = $admin_db->where(array('memberid'=>$id))->save($data);
    		if($result){
    			$this->success('修改成功');
    		}else {
    			$this->error('修改失败');
    		}
		}else{
			$admin_role_db = D('MemberRole');
			$info = $admin_db->getUserInfo($id);
			$rolelist = $admin_role_db->where(array('disabled'=>'0'))->getField('m_roleid,rolename', true);
			$this->assign('info', $info);
			$this->assign('rolelist', $rolelist);
			$this->display('member_edit');
		}
	}

	public function roleList($page = 1, $rows = 10, $sort = 'm_roleid', $order = 'asc'){
		if(IS_POST){
			$admin_role_db = D('MemberRole');
			$total = $admin_role_db->count();
			$order = $sort.' '.$order;
			$limit = ($page - 1) * $rows . "," . $rows;
				$list = $admin_role_db->field('*,m_roleid as id')->order($order)->limit($limit)->select();
			$data = array('total'=>$total, 'rows'=>$list);
			$this->ajaxReturn($data);
		}else{
			$menu_db = D('Menu');
			$currentpos = $menu_db->currentPos(I('get.menuid'));  //栏目位置
			$datagrid = array(
		        'options'     => array(
    				'title'   => $currentpos,
    				'url'     => U('Member/roleList', array('grid'=>'datagrid')),
    				'toolbar' => 'member_rolelist_datagrid_toolbar',
    			),
		        'fields' => array(
		        	// '排序'     => array('field'=>'listorder','width'=>5,'align'=>'center','formatter'=>'adminRoleListOrderFormatter'),
		        	'部门号'       => array('field'=>'m_roleid','width'=>5,'align'=>'center','sortable'=>true),
		        	'部门名称'  => array('field'=>'rolename','width'=>15,'sortable'=>true),
		        	'部门描述'  => array('field'=>'description','width'=>25),
		        	'状态'     => array('field'=>'disabled','width'=>15,'sortable'=>true,'formatter'=>'adminRoleListStateFormatter'),
		        	'管理操作'  => array('field'=>'id','width'=>15,'formatter'=>'adminRoleListOperateFormatter'),
    			)
		    );

		    $this->assign('datagrid', $datagrid);
			$this->display('role_list');
		}
	}

	public function roleAdd(){
		if(IS_POST){
			$admin_role_db = D('MemberRole');
			$data = I('post.info');
			if($admin_role_db->where(array('rolename'=>$data['rolename']))->field('rolename')->find()){
				$this->error('部门名称已存在');
			}
    		$id = $admin_role_db->add($data);
    		if($id){
    			$this->success('添加成功');
    		}else {
    			$this->error('添加失败');
    		}
		}else{
			$this->display('role_add');
		}
	}

	public function roleDelete($id){
		$admin_db = D('MemberRole');
		$result = $admin_db->where(array('m_roleid'=>$id))->delete();
		if ($result){
			$this->success('删除成功');
		}else {
			$this->error('删除失败');
		}
	}

	public function roleEdit($id){
		$admin_role_db = D('MemberRole');
		if(IS_POST){
			$data = I('post.info');
    		$sql = $admin_role_db->where(array('m_roleid'=>$id))->save($data);
    		if($sql){
    			$this->success('修改成功');
    		}else {
    			$this->error('修改失败');
    		}
		}else{
			$info = $admin_role_db->where(array('m_roleid'=>$id))->find();
			$this->assign('info', $info);
			$this->display('role_edit');
		}
	}
	
	public function public_checkRoleName($name){
		if (I('post.default') == $name) {
            $this->error('用户名相同');
        }
        $admin_db = D('MemberRole');
        $exists = $admin_role_db->where(array('rolename'=>$data['rolename']))->field('rolename')->find();
        if ($exists) {
            $this->success('部门存在');
        }else{
            $this->error('部门不存在');
        }
	}
}
