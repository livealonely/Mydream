<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
$(function(){
	$('#system_menu_form_edit_parentid').combotree({url:'<?php echo U('System/public_menuSelectTree');?>'}); 
	$.formValidator.initConfig({formID:"system_menu_edit_dialog_form",onError:function(msg){/*$.messager.alert('错误提示', msg, 'error');*/},onSuccess:systemMenuEditDialogFormSubmit,submitAfterAjaxPrompt:'有数据正在异步验证，请稍等...',inIframe:true});
	$("#system_menu_form_edit_parentid").formValidator({onShow:"请选择上级菜单",onFocus:"上级菜单不能为空"}).inputValidator({min:0,type:'value',onError:"上级菜单不能为空"}).defaultPassed();
	$("#system_menu_form_edit_name").formValidator({onShow:"请输入菜单名称",onFocus:"菜单名称不能为空",onCorrect:"输入正确"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:'菜单名称不能有空格'},onError:"菜单名称不能为空"}).ajaxValidator({
		type : "post",
		url : "<?php echo U('System/public_menuNameCheck');?>",
		data : {name:function(){return $("#system_menu_form_edit_name").val()},default:'<?php echo ($data["name"]); ?>' },
		datatype : "json",
		async:'false',
		success : function(res){
			var json = $.parseJSON(res);
            return json.status == 1 ? false : true;
		},
		onError : "菜单名称已存在",
		onWait : "请稍候..."
	}).defaultPassed();
	$("#system_menu_form_edit_c").formValidator({onShow:"请输入模块名",onFocus:"模块名不能少于2个字符"}).inputValidator({min:2,empty:{leftEmpty:false,rightEmpty:false,emptyError:'模块名不能有空格'},onError:"模块名不能少于2个字符"}).regexValidator({
		regExp:"^([A-Z][a-z1-9]+)+$",
		param : "",
		dataType:"string",
		onError:"必须为首字母大写的驼峰法命名"
	}).defaultPassed();
	$("#system_menu_form_edit_a").formValidator({onShow:"请输入方法名",onFocus:"方法名不能少于2个字符"}).inputValidator({min:2,empty:{leftEmpty:false,rightEmpty:false,emptyError:'方法名不能有空格'},onError:"方法名不能少于2个字符"}).regexValidator({
		regExp:"^[a-z][a-z1-9_]+([A-Z][a-z1-9]+)?$",
		param : "",
		dataType:"string",
		onError:"必须为首字母小写的驼峰法命名"
     }).defaultPassed();
})
function systemMenuEditDialogFormSubmit(){
	$.post('<?php echo U('System/menuEdit?id='.$data['id']);?>', $("#system_menu_edit_dialog_form").serialize(), function(res){
		if(!res.status){
			$.messager.alert('提示信息', res.info, 'error');
		}else{
			$.messager.alert('提示信息', res.info, 'info');
			$('#system_menu_edit_dialog').dialog('close');
			systemMenuRefresh();
		}
	})
}
</script>
<form id="system_menu_edit_dialog_form">
<table>
	<tr>
		<td width="100">上级菜单：</td>
		<td><input id="system_menu_form_edit_parentid" name="info[parentid]" value="<?php echo ($data["parentid"]); ?>" class="easyui-combotree" value="<?php echo ((isset($_GET['parentid']) && ($_GET['parentid'] !== ""))?($_GET['parentid']):0); ?>" style="width:180px;height:26px" /></td>
		<td><div id="system_menu_form_edit_parentidTip"></div></td>
	</tr>
	<tr>
		<td>菜单名称：</td>
		<td><input id="system_menu_form_edit_name" name="info[name]" value="<?php echo ($data["name"]); ?>" type="text" style="width:178px;height:22px" /></td>
		<td><div id="system_menu_form_edit_nameTip"></div></td>
	</tr>
	<tr>
		<td>模块名：</td>
		<td><input id="system_menu_form_edit_c" name="info[c]" value="<?php echo ($data["c"]); ?>" type="text" style="width:178px;height:22px" /></td>
		<td><div id="system_menu_form_edit_cTip"></div></td>
	</tr>
	<tr>
		<td>方法名：</td>
		<td><input id="system_menu_form_edit_a" name="info[a]" value="<?php echo ($data["a"]); ?>" type="text" style="width:178px;height:22px" /></td>
		<td><div id="system_menu_form_edit_aTip"></div></td>
	</tr>
	<tr>
		<td>附加参数：</td>
		<td><input class="input_show" name="info[data]" value="<?php echo ($data["data"]); ?>" type="text" style="width:178px;height:22px" /></td>
		<td></td>
	</tr>
	<tr>
		<td>是否显示菜单：</td>
		<td colspan="2">
			<label><input name="info[display]" value="1" type="radio" <?php if(($data["display"]) == "1"): ?>checked<?php endif; ?> />是</label>
			<label><input name="info[display]" value="0" type="radio" <?php if(($data["display"]) == "0"): ?>checked<?php endif; ?> />否</label>
		</td>
	</tr>
</table>
</form>