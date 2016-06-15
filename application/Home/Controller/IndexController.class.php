<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){

    	/*查询表的应用类型*/
   		$arr = M('apply')->select();
   		$this->assign('apply',$arr);
   		






   		$this->display();	
    }
}