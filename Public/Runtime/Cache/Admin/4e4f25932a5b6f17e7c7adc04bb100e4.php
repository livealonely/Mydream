<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
$(function(){
	$.formValidator.initConfig({formID:"admin_rolelist_edit_dialog_form",onError:function(msg){/*$.messager.alert('错误提示', msg, 'error');*/},onSuccess:adminRolelistEditDialogFormSubmit,submitAfterAjaxPrompt:'有数据正在异步验证，请稍等...',inIframe:true});
	$("#admin_rolelist_edit_dialog_form_name").formValidator({onShow:"请输入角色名称",onFocus:"角色名称不能为空"}).inputValidator({min:1,max:999,onError:"角色名称不能为空"}).ajaxValidator({
		type : "post",
		url : "<?php echo U('Admin/public_checkRoleName');?>",
		data : {rolename:function(){return $("#admin_rolelist_edit_dialog_form_name").val()}, default:'<?php echo ($info["rolename"]); ?>'},
		datatype : "json",
		async:'false',
		success : function(data){
			var json = $.parseJSON(data);
            return json.status == 1 ? false : true;
		},
		onError : "角色名称已存在",
		onWait : "请稍候..."
	});
})
function adminRolelistEditDialogFormSubmit(){
	$.post('<?php echo U('Admin/roleEdit?id='.$info['roleid']);?>', $("#admin_rolelist_edit_dialog_form").serialize(), function(res){
		if(!res.status){
			$.messager.alert('提示信息', res.info, 'error');
		}else{
			$.messager.alert('提示信息', res.info, 'info');
			$('#admin_rolelist_edit_dialog').dialog('close');
			adminRoleListRefresh();
		}
	})
}
</script>
<form id="admin_rolelist_edit_dialog_form">
<table cellspacing="6" width="100%">
	<tr>
		<td width="80">角色名称：</td>
		<td><input id="admin_rolelist_edit_dialog_form_name" type="text" name="info[rolename]" value="<?php echo ($info["rolename"]); ?>" style="width:180px;height:22px" /></td>
		<td><div id="admin_rolelist_edit_dialog_form_nameTip"></div></td>
	</tr>
	<tr>
		<td>角色描述：</td>
		<td colspan="2"><textarea name="info[description]" style="width:90%;height:60px;font-size:12px"><?php echo ($info["description"]); ?></textarea></td>
	</tr>
	<tr>
		<td>是否启用：</td>
		<td colspan="2"><label><input type="radio" name="info[disabled]" value="0" <?php if(($info["disabled"]) == "0"): ?>checked<?php endif; ?> />启用</label> <label><input type="radio" name="info[disabled]" value="1" <?php if(($info["disabled"]) == "1"): ?>checked<?php endif; ?> />禁止</label></td>
	</tr>
	<tr>
		<td>排序：</td>
		<td colspan="2"><input type="text" name="info[listorder]" value="<?php echo ($info["listorder"]); ?>" style="width:40px;height:22px" /></td>
	</tr>
</table>
</form>