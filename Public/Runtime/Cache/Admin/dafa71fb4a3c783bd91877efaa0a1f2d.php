<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
$(function(){
	$.formValidator.initConfig({formID:"admin_rolelist_add_dialog_form",onError:function(msg){/*$.messager.alert('错误提示', msg, 'error');*/},onSuccess:adminRolelistAddDialogFormSubmit,submitAfterAjaxPrompt:'有数据正在异步验证，请稍等...',inIframe:true});
})
function adminRolelistAddDialogFormSubmit(){
	$.post('<?php echo U('Member/roleAdd');?>', $("#admin_rolelist_add_dialog_form").serialize(), function(res){
		if(!res.status){
			$.messager.alert('提示信息', res.info, 'error');
		}else{
			$.messager.alert('提示信息', res.info, 'info');
			$('#admin_rolelist_add_dialog').dialog('close');
			adminRoleListRefresh();
		}	
	})
}
</script>
<form id="admin_rolelist_add_dialog_form">
<table cellspacing="6" width="100%">
	<tr>
		<td>订单名称：</td>
		<td><input id="ordername" type="text" name="info[ordername]" style="width:180px;height:22px" /></td>
	</tr>
	<tr>
		<td>客户公司：</td>
		<td><input id="order_company" type="text" name="info[company]" style="width:180px;height:22px" /></td>
	</tr>
	<tr>
		<br>
		&nbsp;时间: <input name="search[begin]" class="easyui-datebox" style="width:100px">
		至: <input name="search[end]" class="easyui-datebox" style="width:100px">
	</tr>
	<tr>
		<td>订单描述：</td>
		<td colspan="2"><textarea name="info[description]" style="width:90%;height:60px;font-size:12px"></textarea></td>
	</tr>
	<td>所属部门：</td>
		<td>
		<select id="admin_memberlist_add_dialog_form_role" class="easyui-combobox" data-options="editable:false,panelHeight:'auto'" name="info[department]" style="height:25px">
			<?php if(is_array($rolelist)): foreach($rolelist as $m_roleid=>$rolename): ?><option value="<?php echo ($m_roleid); ?>"><?php echo ($rolename); ?></option><?php endforeach; endif; ?>
			</select>
		</td>
	</tr>
</table>
</form>