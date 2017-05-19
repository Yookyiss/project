<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=yes">
<link type="text/css" rel="stylesheet" href="__PUBLIC__/acss/base.css" />
<link type="text/css" rel="stylesheet" href="__PUBLIC__/acss/bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="__PUBLIC__/acss/style.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/acss/category.css" />
<title>标题</title>
<script src="__PUBLIC__/ajs/jquery-1.9.1.min.js"></script>
<script src="__PUBLIC__/ajs/Validform_v5.3.2_min.js"></script>
<script charset="utf-8" src="__PUBLIC__/ajs/kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="__PUBLIC__/ajs/kindeditor/lang/zh_CN.js"></script>
<link rel="stylesheet" href="__PUBLIC__/ajs/kindeditor/themes/default/default.css" />
<script type="text/javascript" src="__PUBLIC__/ajs/picker/WdatePicker.js"></script>

</head>

<script>
$(function(){
	$('header .nav').click(function(){
		$('nav').slideToggle(0);
		$('#content, aside').toggleClass('margin'); 
  	});
})
</script>

<body>
<!--头部-->
<header>
	<div class="nav">
    	 <ul>
         <li></li>
         <li></li>
         <li></li>
         </ul>	 
    </div>
	<div style="position:absolute;right:10px;top:0px;margin-top:8px;font-size:14px;color:white;">您好！:<?php echo (session('username')); ?> 【管理员】<a style="color:white;" href="__APP__/Login/doLogout">【退出】</a></div>
</header>
<!--左侧导航-->
<nav>
	<div class="navTop">
    	 <dl><img src="__PUBLIC__/aimages/avatar2.jpg" width="120" height="120"></dl>
         <ul>
         	<li class="navTop_01"><a href="/" title="返回首页">返回首页</a></li>
            <li class="navTop_02"><a href="__APP__/Site/site" title="网站设置">网站设置</a></li>
            <li class="navTop_03"><a href="__APP__/Login/doLogout" title="退出后台">退出后台</a></li>
         </ul>
    </div>
    <div class="navList">
    	 <ul>
			 <li><a  <?php if($_GET['cls'] == 1): ?>class="this"<?php endif; ?> href="__APP__/Index/index/cls/1" >默认页面</a></li>
			 <li><a <?php if($_GET['cls'] == 2): ?>class="this"<?php endif; ?>  href="__APP__/Category/category/cls/2" >栏目</a></li>
			 <li><a <?php if($_GET['cls'] == 5): ?>class="this"<?php endif; ?>  href="__APP__/Index/picture/cls/5">首页图片</a></li> 
			 <li><a <?php if($_GET['cls'] == 3): ?>class="this"<?php endif; ?>  href="__APP__/Link/index/cls/3">二级菜单</a></li> 
			 <li><a <?php if($_GET['cls'] == 6): ?>class="this"<?php endif; ?>  href="__APP__/Link/parameter/cls/6">产品参数</a></li> 
			 <li><a <?php if($_GET['cls'] == 4): ?>class="this"<?php endif; ?>  href="__APP__/Index/admin/cls/4">后台用户</a></li>
         </ul>
    </div>
</nav>
<!--快捷导航-->
<aside>
	 <ul>

        <li><a href="__APP__/Index/addAdmin/cls/4" class="backgroundColorLan">新增用户</a></li>
     </ul>
</aside>
<!--内容-->
<script src="__PUBLIC__/js/diy.js"></script>

<div id="content">

<!--breadcrumbs-->
<div id="breadcrumb"> <a href="__APP__/Index/index/cls/1" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>主页</a><span class="nadd">->&nbsp;&nbsp;&nbsp;前台首页设置</span></div>

<!--End-breadcrumbs-->

<!--Action boxes-->

  <div class="container-fluid">

    <div class="quick-actions_homepage">

      <ul class="quick-actions">

       <li class="bg_lb"> <a href="__APP__/Index/index/cls/1"> <i class="icon-pencil"></i>后台首页</a></li>



      </ul>

    </div>

<!--End-Action boxes--> 

 <div class="row-fluid">

     <div class="span12">

        <div class="widget-box">

          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>

            <h5>前台设置</h5>
				
          </div>

          <div class="widget-content nopadding">

	

          	<table class="table table-bordered table-striped">

             <thead>

              <tr>
	
				
				<th width="15%">首页标签</th>
				
				<th>内容</th>

			

              </tr>

            </thead>

            <tbody>

		<form action="__URL__/doSite" method="post">
			
	<?php if($list == null): ?><tr>
					
				<td style="text-align:center;">标题</td>

			    <td ><input type="text" name="stitle" value="" style="width:250px;margin:0 0 0 8px;"/></td>
					
	 		  </tr>
			  <tr>
					
				<td style="text-align:center;">关键词</td>

			    <td><input type="text" name="skeywords" value="" style="width:250px; margin:0 0 0 8px;"/></td>
					
	 		  </tr>
			  
			  <tr>
					
				<td style="text-align:center;">描述</td>

			    <td><input type="text" name="sdescription" value="" style="width:250px; margin:0 0 0 8px;"/></td>
					
	 		  </tr>
			  <tr>

             	<td colspan="2"><input type="reset" class="btn btn-primary" value="重置"/>&nbsp;&nbsp;<input type="submit" value="提交" class="btn btn-success delpic"/></td>

             </tr>
		 
			 <?php else: ?>
			 		<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
					
				<td style="text-align:center;">标题</td>

			    <td ><input type="text" name="stitle" value="<?php echo ($v["stitle"]); ?>" style="width:250px;margin:0 0 0 8px;"/></td>
					
	 		  </tr>
	

			
			  <tr>
					
				<td style="text-align:center;">关键词</td>

			    <td><input type="text" name="skeywords" value="<?php echo ($v["skeywords"]); ?>" style="width:250px; margin:0 0 0 8px;"/></td>
					
	 		  </tr>
			  
			  <tr>
					
				<td style="text-align:center;">描述</td>

			    <td><input type="text" name="sdescription" value="<?php echo ($v["sdescription"]); ?>" style="width:250px; margin:0 0 0 8px;"/></td>
					
	 		  </tr>
			  <tr>

             	<td colspan="2"><input type="reset" class="btn btn-primary" value="重置"/>&nbsp;&nbsp;<input type="submit" value="提交" class="btn btn-success delpic"/></td>

             </tr><?php endforeach; endif; endif; ?>
		 
		  </form>	
			
            </tbody>
			
          </table>

		

		  <div class='fanye clearfix'>     </div>
		  <script type="text/javascript">

			function del(val){

				if(confirm("是否删除?")){

					sendRequest(val);

				}

			}

			function sendRequest(val){

				$.ajax({

					   type: "POST",

					   url: "__APP__/Picture/delPicture/",

					   data: "pid="+val,

					   success: function(data){

					     if(data){

						     alert("删除成功");

					     	 window.location.reload();

					     }

					     else{

					    	 alert("删除失败");

						 }

					   }

					}); 

			}

		
		  </script>

          </div>

        </div>

    </div>

  </div>

  <div class="row-fluid">

 <div id="footer"> <small>

      <!-- Remove this notice or replace it with whatever you want -->

      CopyRight ©2005-2013  Shanghai MoFang Design Co.,Ltd

 </small> </div>

    <!-- End #footer -->

  </div>

  <!-- End #main-content -->

</div>

</body>


</html>