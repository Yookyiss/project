<?php
header( 'Content-Type:text/html;charset=utf-8 ');
// 本类由系统自动生成，仅供测试用途
class ProductAction extends CommonAction {
	private $pro_db,$cate_db,$link_db,$pro_price_db,$para_db,$problem_db;
	function __construct() {
		$this->pro_db=M("Product");
		$this->cate_db=M("Category");
		$this->link_db=M("Linkage");
		$this->pro_price_db=M("Product_price");
		$this->para_db=M("Parameter");
		$this->problem_db=M("Problem");
		parent::__construct();
	}
	
	
	//产品列表
	public function product(){
		$catid=intval($_GET['catid']);
		import('ORG.Util.Page');
		$count=$this->pro_db->where("catid=$catid")->count();
		$page  = new Page($count,10);
		$show=$page->show();
		$pro_list=$this->pro_db->field("id,status,listorder,title,posid,inputtime,xqstatus")->order("listorder desc,id desc")->where("catid=$catid")->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('pro_list',$pro_list);
		$this->assign('catid',$catid);
		$this->assign('show',$show);
		$this->display();
	}
	
	
	//添加产品页面
	public function addProduct(){
		$catid=intval($_GET['catid']);
		$cate_arr=$this->cate_db->field("catname,catid")->where("catid=$catid")->find();
		$link_list=$this->link_db->field("linkageid,name")->where("catid=$catid")->select();
		
		$problem_list=$this->problem_db->field("id,title")->where("status=1")->order("listorder desc,id desc")->select();
		$texture_list=$this->para_db->field("id,name,colorname")->where('status=1 and typeid=2')->order("listorder desc,id desc")->select();
		$para_list=$this->para_db->field("id,name,colorname")->where('status=1  and typeid=1')->order("listorder desc,id desc")->select();
		$msg="";
			foreach($para_list as $k=>$vo){
				$msg.= '<div class="htdian" style="width:100px;"><span><input type="radio" name="info[colorlist][xxx0]" value="'.$vo['id'].'" ';	
				if($k==0){
									$msg.='checked';
				}
							$msg.=' item="val"></span><span class="httxt">'.$vo['name'].'</span><span class="htdiansp" style="width: 20px;height: 20px;display: block;background-color:'.$vo['colorname'].';"></span></div>';						
				}

		$this->assign('msg',$msg);
		$this->assign("para_list",$para_list);
		$this->assign("texture_list",$texture_list);
		$this->assign("link_list",$link_list);
		$this->assign('cate_arr',$cate_arr);
		$this->assign("problem_list",$problem_list);
		$this->display();
	
	}
	
	
	//修改产品页面
	public function upProduct(){
		$id=intval($_GET['id']);
		$catid=intval($_GET['catid']);
		$cate_arr=$this->cate_db->field("catname,catid")->where("catid=$catid")->find();
		$pro_arr=$this->pro_db->where("id=$id")->find();
		$link_list=$this->link_db->field("linkageid,name")->where("catid=$catid")->select();
		$problem_list=$this->problem_db->field("id,title")->where("status=1")->order("listorder desc,id desc")->select();
		$para_list=$this->para_db->field("id,name,colorname")->where('status=1 and typeid=1')->order("listorder desc,id desc")->select();
		$texture_list=$this->para_db->field("id,name,colorname")->where('status=1 and typeid=2')->order("listorder desc,id desc")->select();	
		
		$price_list=$this->pro_price_db->where("pid=$id")->select();
		foreach($price_list as $k=>$v){
			$price_list[$k]['texturelist']=explode(",",$v['texturelist']);
			
		}

		
			$msg="";
				foreach($para_list as $k=>$vo){
				$msg.= '<div class="htdian" style="width:100px;"><span><input type="radio" name="info[colorlist][xxx0]" value="'.$vo['id'].'" ';	
				if($k==0){
									$msg.='checked';
				}
							$msg.=' item="val"></span><span class="httxt">'.$vo['name'].'</span><span class="htdiansp" style="width: 20px;height: 20px;display: block;background-color:'.$vo['colorname'].';"></span></div>';						
				}
					
		$this->assign("problem_list",$problem_list);		
		$this->assign('msg',$msg);
		$this->assign("price_list",$price_list);
		$this->assign("para_list",$para_list);
		$this->assign("texture_list",$texture_list);
		$this->assign("link_list",$link_list);
		$this->assign('cate_arr',$cate_arr);
		$this->assign('pro_arr',$pro_arr);
		$this->display();
	}
	
	
	//产品删除
	public function delProduct(){
		$id=intval($_POST['id']);
		$this->pro_db->where("id=$id")->delete();
		$data=$this->pro_price_db->where("pid=$id")->delete();
		echo $data;
	}


	public function doProduct(){
		$action=$_GET['action'];
		$info=$_POST['info'];
		$info['content']=stripslashes($info['content']);
		$info_price=$_POST['info_price'];
		$count_price=count($info_price['capacity']);
		$info_price_up=$_POST['info_price_up'];
		 import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  './Public/Uploads/';// 设置附件上传目录
		$upload->upload();
		$msg =  $upload->getUploadFileInfo();
		if($action=="add"){//添加产品
			$info['inputtime']=strtotime($info['inputtime']);	
			if(empty($info['colorlist'])){
				$info['colorlist']='';
			}else{
				$info['colorlist']=implode(",",$info['colorlist']);
			}
			$pid=$this->pro_db->add($info);
			for($j=0;$j<$count_price;$j++){
				 if($info_price['capacity'][$j] !=""  || $info_price['price'][$j] !=""){
					$data['pid']=$pid;
					$data['capacity']=$info_price['capacity'][$j];
					$data['price']=$info_price['price'][$j];
					$data['texturelist']=implode(",",$info_price['texturelist'][$j]);
					$data['fmpicurl']=$msg[$j]['savepath'].$msg[$j]['savename'];
					$this->pro_price_db->add($data);
				
				}
			}
					
			$this->success("发布成功");
		
		}elseif($action=="edit"){//编辑产品
			$id=intval($_GET["id"]);
			$info['updatetime']=strtotime($info['updatetime']);	
			$info_price_up=$_POST['info_price_up'];
			if(empty($info['colorlist'])){
				$info['colorlist']='';
			}else{
				$info['colorlist']=implode(",",$info['colorlist']);
			}
			 $this->pro_db->where("id=$id  and catid=".$info['catid'])->save($info);
			 
			 //价格区间如有新增则添加
			if($info_price){
			  for($j=0;$j<$count_price;$j++){
					 if($info_price['capacity'][$j] !=""  || $info_price['price'][$j] !=""){
						$data['pid']=$id;
						$data['capacity']=$info_price['capacity'][$j];
						$data['price']=$info_price['price'][$j];
						$data['texturelist']=implode(",",$info_price['newtexturelist'][$j]);
						$this->pro_price_db->add($data);
					}
				 }
				 			
				}
			 
		
			 
			//修改价格区间			
			foreach($info_price_up as $k=>$v){
				if(empty($v['texturelist'])){
					$v['texturelist']='';
				}else{
					$v['texturelist']=implode(",",$v['texturelist']);	
				}	
				 $this->pro_price_db->where("id=".$k)->save($v);
			}
			$pro_picur_list=$this->pro_price_db->field("id")->where("pid=$id")->select();

			$i=0;
			foreach ($pro_picur_list as $k=>$v){
				if($_FILES['fmpicurl']['error'][$k]==0){
					$picinfo['fmpicurl']="/bobo2". ltrim($msg[$i]['savepath'],'.').$msg[$i]['savename'];
					$this->pro_price_db->where("id=".$v['id'])->save($picinfo);
					$i++;
				}
				
			}
			
			$this->success("修改成功");
		}else{	
			$this->error("非法操作");
		}
	}
	
	
	//文章排序
	public function conOrder(){
		$listorder=$_POST['listorder'];
		$catid=intval($_POST['catid']);
		foreach($listorder as $k=>$v){
			$this->pro_db->where("id=$k")->order("listorder")->save(array("listorder"=>$v));	
		}
		$this->redirect("Product/product",array("catid"=>$catid,"cls"=>2));
	}
	
	
	//产品是否显示
	public function show(){
		$id=intval($_POST['id']);
		$status=intval($_POST['status']);
		$data['status']=$status;
		$da=$this->pro_db->where("id=$id")->save($data);
		echo $da;
	}
	
	//产品是否显示
	public function showxq(){
		$id=intval($_POST['id']);
		$status=intval($_POST['xqstatus']);
		$data['xqstatus']=$status;
		$da=$this->pro_db->where("id=$id")->save($data);
		echo $da;
	}
	
	
	
	//产品是否推荐
	public function posid(){
		$id=intval($_POST['id']);
		$posid=intval($_POST['posid']);
		$data['posid']=$posid;
		$da=$this->pro_db->where("id=$id")->save($data);
		echo $da;
	}

	
	//搜索文章
	public function conSearch(){
		$factor=$_GET['factor'];
		$catid=intval($_GET['catid']);
		$search=$_GET['search'];
		if(!$search){
			$this->redirect('Product/product',array('catid'=>$catid,'cls'=>2));
		}
		if($factor==1){
			$where="title  like '%$search%' and catid=$catid";
		}
		// 计算总数
		$count = $this->pro_db->where($where)->count();
		// 导入分页类
		import("ORG.Util.Page");
		// 实例化分页类
		$p = new Page($count,10);
		// 分页显示输出
		$show = $p->show();
		// 当前页数据查询
		$pro_list = $this->pro_db->field("id,status,listorder,title,posid,inputtime,xqstatus")->where($where)->order("listorder desc,id desc")->limit($p->firstRow.','.$p->listRows)->select();	
		$this->assign('show', $show);
		$this->assign('pro_list', $pro_list);
		$this->assign('catid',$catid);
		$this->display();
	}
	
      
		//删除价格信息
	function delPric(){
		$id=intval($_POST['id']);
		$data=$this->pro_price_db->where("id=$id")->delete();
		
		echo $data;
		
		
	}


}