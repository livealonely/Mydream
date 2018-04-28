<?php
namespace Admin\Model;
use Think\Model;

class MemberRoleModel extends Model{
    protected $tableName = 'member_role';
	protected $pk        = 'm_roleid';
	public    $error;
	
	/**
	 * 获取角色中文名称
	 * @param int $roleid 角色ID
	 */
	public function getRoleName($roleid) {
		$roleid = intval($roleid);
		$rolename = $this->where(array('m_roleid'=>$roleid))->getField('rolename');
		return $rolename;
	}
}