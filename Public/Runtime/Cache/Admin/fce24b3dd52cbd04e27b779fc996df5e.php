<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
$(function(){
	$.formValidator.initConfig({formID:"admin_memberlist_edit_dialog_form",onError:function(msg){/*$.messager.alert('错误提示', msg, 'error');*/},onSuccess:adminMemberlistEditDialogFormSubmit,submitAfterAjaxPrompt:'有数据正在异步验证，请稍等...',inIframe:true});
	// $("#admin_memberlist_edit_dialog_form_password").formValidator({empty:true,onShow:"不修改密码请留空",onFocus:"密码应该为6-20位之间"}).inputValidator({min:6,max:20,onError:"密码应该为6-20位之间"});
	// $("#admin_memberlist_edit_dialog_form_pwdconfirm").formValidator({onShow:"不修改密码请留空",onFocus:"请输入确认密码"}).compareValidator({desID:"admin_memberlist_edit_dialog_form_password",operateor:"=",onError:"输入两次密码不一致"});
	// $("#admin_memberlist_edit_dialog_form_email").formValidator({onShow:"请输入E-mail",onFocus:"请输入E-mail"}).regexValidator({regExp:"email",dataType:"enum",onError:"E-mail格式错误"}).ajaxValidator({
	// 	type : "post",
	// 	url : "<?php echo U('Admin/public_checkEmail');?>",
	// 	data : {email: function(){return $("#admin_memberlist_edit_dialog_form_email").val()}, default: '<?php echo ($info["email"]); ?>'},
	// 	datatype : "json",
	// 	async:'false',
	// 	success : function(data){
	// 		var json = $.parseJSON(data);
 //            return json.status == 1 ? false : true;
	// 	},
	// 	onError : "该邮箱已经存在",
	// 	onWait : "请稍候..."
	// });
	// $("#admin_memberlist_edit_dialog_form_realname").formValidator({onShow:"请输入真实姓名",onFocus:"真实姓名应该为2-20位之间"}).inputValidator({min:2,max:20,empty:{leftEmpty:false,rightEmpty:false,emptyError:"姓名两边不能有空格"},onError:"真实姓名应该为2-20位之间"});
	// $("#admin_memberlist_edit_dialog_form_role").formValidator({onShow:"请选择角色",onFocus:"请选择角色"}).inputValidator({min:0,onError:"请选择角色"});
})
function adminMemberlistEditDialogFormSubmit(){
	$.post('<?php echo U('Member/memberEdit?id='.$info['memberid']);?>', $("#admin_memberlist_edit_dialog_form").serialize(), function(res){
		if(!res.status){
			$.messager.alert('提示信息', res.info, 'error');
		}else{
			$.messager.alert('提示信息', res.info, 'info');
			$('#admin_memberlist_edit_dialog').dialog('close');
			adminMemberRefresh();
		}
	})
}
</script>
<form id="admin_memberlist_edit_dialog_form">
<table>
	<tr>
		<td width="80">用户名：</td>
		<td><input id="admin_memberlist_edit_dialog_form_name" type="text" name="info[username]" value="<?php echo ($info["username"]); ?>" style="width:180px;height:22px" /></td>
		<td></td>
	</tr>
	<tr>
	<td>所属部门：</td>
		<td>
		<select id="admin_memberlist_add_dialog_form_role" class="easyui-combobox" data-options="editable:false,panelHeight:'auto'" name="info[department]" style="height:25px">
			<?php if(is_array($rolelist)): foreach($rolelist as $m_roleid=>$rolename): ?><option value="<?php echo ($m_roleid); ?>"><?php echo ($rolename); ?></option><?php endforeach; endif; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>职位：</td>
		<td><input id="admin_memberlist_edit_dialog_form_pwdconfirm" type="text" name="info[job]" value="<?php echo ($info["job"]); ?>" style="width:180px;height:22px" /></td>
		<td><div id="admin_memberlist_edit_dialog_form_pwdconfirmTip"></div></td>
	</tr>
	<tr>
		<td>电话：</td>
		<td><input id="admin_memberlist_edit_dialog_form_email" type="text" name="info[phone]" value="<?php echo ($info["phone"]); ?>" style="width:180px;height:22px" /></td>
		<td><div id="admin_memberlist_edit_dialog_form_emailTip"></div></td>
	</tr>
	<tr>
		<td>QQ：</td>
		<td><input id="admin_memberlist_edit_dialog_form_realname" type="text" name="info[QQ]" value="<?php echo ($info["QQ"]); ?>" style="width:180px;height:22px" /></td>
		<td><div id="admin_memberlist_edit_dialog_form_realnameTip"></div></td>
	</tr>
	<!-- <tr>
		<td>所属角色：</td>
		<td>
			<select id="admin_memberlist_edit_dialog_form_role" class="easyui-combobox" data-options="editable:false,panelHeight:'auto'" name="info[roleid]" style="height:25px">
			<?php if(is_array($rolelist)): foreach($rolelist as $roleid=>$rolename): ?><option value="<?php echo ($roleid); ?>" <?php if(($info["roleid"]) == $roleid): ?>selected<?php endif; ?>><?php echo ($rolename); ?></option><?php endforeach; endif; ?>
			</select>
		</td>
		<td><div id="admin_memberlist_edit_dialog_form_roleTip"></div></td>
	</tr> -->
</table>
</form>