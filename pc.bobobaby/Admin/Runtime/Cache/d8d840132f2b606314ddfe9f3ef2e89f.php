<?php if (!defined('THINK_PATH')) exit();?><link type="text/css" rel="stylesheet" href="__PUBLIC__/acss/base.css" />
<link type="text/css" rel="stylesheet" href="__PUBLIC__/acss/bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="__PUBLIC__/acss/style.css" />


     <div class="span12" style="width:760px">
	 



        <div class="widget-box">

          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>

            <h5>详情</h5>
				
          </div>

     	<table class="table table-bordered table-striped">
     	 <tr >		  <td><span>用户名：</span></td><td width="540px"><?php echo ($try_arr["username"]); ?></td>		  </tr>	
		  <tr >
		  <td><span>姓名：</span></td><td width="540px"><?php echo ($try_arr["name"]); ?></td>
		  </tr>						  <tr >		  <td><span>产品：</span></td><td width="540px"><?php echo ($try_arr["title"]); ?>&nbsp;&nbsp;<?php echo ($try_arr["capacity"]); ?></td>		  </tr>		  <tr >		  <td><span>电话：</span></td><td width="540px"><?php echo ($try_arr["phone"]); ?></td>		  </tr>		<tr >		  <td><span>地址：</span></td><td width="540px"><?php echo ($try_arr["address"]); ?></td>		  </tr>			<tr >		  <td><span>产品试用评价：</span></td><td width="540px"><?php echo ($try_arr["evaluate"]); ?></td>		  </tr>	

	</div>
	
	 
</div>
</div>