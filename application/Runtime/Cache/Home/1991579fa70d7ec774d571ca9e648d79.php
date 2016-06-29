<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body style="padding-top:250px;background-color:#649">
	<table border = "20"  width="400px" height="200px"cellpadding="0" cellspacing="0" align="center"bgcolor="#ccc">
		<tr>
			<td colspan="2" align="center">用户登录</td>
		</tr>
		<tr>
			<td align="center">用户名</td>
			<td align="center"><input type="text" name="username"class ="user" style="width:200px"/></td>
		</tr>
		<tr>
			<td align="center">密码</td>
			<td align="center"><input type="password" name="password" class ="pass" style="width:200px"/></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><button class="login" style="width:200px">登录</button></td>
		</tr>
	</table>

<script src="/getsql/Public/js/jquery.min.js"></script>
<script>
	$(".login").click(function(){
		var arr={};
	 	var a =$('.user').val();
	 	var b =$('.pass').val();
	 	arr['password']= b;
	 	arr['username']= a;
	 	$.post("<?php echo U('Index');?>", arr, function(data){
	 		if(data.status){
				alert('登录成功');
				window.location.reload();
	 		} else {
	 			alert('登录失败');
	 			//window.location.reload();
	 		}
	 	});
	 });
</script>
</body>

</html>