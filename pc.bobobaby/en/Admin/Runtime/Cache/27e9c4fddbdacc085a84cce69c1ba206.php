<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=yes">
<link type="text/css" rel="stylesheet" href="__PUBLIC__/acss/base.css" />
<link type="text/css" rel="stylesheet" href="__PUBLIC__/acss/style.css" />
<title>登录</title>
<meta name="keywords" content="关键字,关键字" />
<meta name="description" content="描述" />

</head>

<body style="background:#2e363f;">
	<form class="registerform" action="__URL__/doLogin"  method="post">
		<div id="login">
			 <div class="login">
				  <ul><img src="__PUBLIC__/aimages/logo.png" width="178"></ul>
				  <dl>
					  <dt><img src="__PUBLIC__/aimages/pic_03.gif"><input name="username" type="text" datatype="*" nullmsg="请填写用户名" /></dt>
					  <dt><img src="__PUBLIC__/aimages/pic_04.gif"><input name="password" type="password" datatype="*" nullmsg="请填写密码"/></dt>
					  <dd><input type="submit" name="" value="登录"></dd>
				  </dl>
			 </div>
		</div>
    </form>
<script src="__PUBLIC__/ajs/jquery-1.9.1.min.js"></script>
<script src="__PUBLIC__/ajs/Validform_v5.3.2_min.js"></script>

<script type="text/javascript">
	$(function(){	
		$(".registerform").Validform({
			ajaxPost:true,
			tiptype:1,
			callback:function(arr){
			if(arr.status=="1"){
				setTimeout(function(){
					window.location="__APP__/Index/index/cls/1";
				},2000);
			}
		}
		
		});		
	})
</script>
</body>
</html>