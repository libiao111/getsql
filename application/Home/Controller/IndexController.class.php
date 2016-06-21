<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller 
{
    public function index()
    {
      /*
      查询数据类型
      */
      $ar = M('datatype')->select();
      //p($ar);
      $this->assign('dat',$ar);
      /*
    	查询表的应用类型
	    */
   		$arr = M('apply')->select();
      //p($arr);
      $this->assign('apply',$arr);
   		/*
   		查询表名
   		 */
   		$arr1 = M('table')->select();
      foreach ($arr1 as $key => $v) 
      {
        /*
      以表名id关联查询field表
       */
          $where = array(
              'table_id'=>$v['id']
          );
          $arr2 = M('field')->where($where)->select();

          //p($arr2);
              foreach ($arr2 as $k => $va) 
              {
                    /*
                  以field的表data_id关联查询字段类型 
                   */
                  $where1 = array(
                      'id'=>$va['data_id']
                  );
               
                  $arr3 = M('datatype')->where($where1)->getField('data_name');
                  //赋值
                  $va['data_name']=$arr3;
                  $arr2[$k]=$va;
              }
              //赋值
              $v['bb'] =$arr2;
              $arr1[$key]=$v;
      }
      $this->assign('table',$arr1);
      $this->display();	
    }
	 /*
		添加表操作 和修改表操作
	 */
  
    public function addtable()
    {

    	if(!IS_AJAX)
      {
    		$this->error('页面不存在!');die; 
    	}
    	$arr = I('table_array');
      
      
      if($arr['id'])
      {
        $result = M('table')->save($arr);
      }else
      {
        $result = M('table')->add($arr);
      }
    	
    	if($result)
      {
    		$data = array('status'=>1);
    	}else
      {
    		$data = array('status'=>0);
    	}
    	$this->ajaxReturn($data,'json');
    }
   
    /*
    删除表操作
     */
    public function delete1()
    {
      if(!IS_AJAX)
      {
          $this->error('页面不存在!');die;
      }
          $arr =I('id');

          $sql = M('field')->where(array('table_id'=>$arr))->delete();
      if($sql)
      {
          $result = M('table')->where(array('id'=>$arr))->detele();
      }
     if($result)
      {
          $data = array('status'=>1);
      }else
      {
          $data = array('status'=>0);
      }
          $this->ajaxReturn($data,'json');
    }

    /*
    查询表是否存在
     */
    public function checktable()
    {
        if(!IS_AJAX)
        {
            $this->error('页面不存在!');die;
        }
            $arr= I('table_array ');
            $result = M('table')->where($arr)->select(); 

        if($result)
        {
            $data = array('status'=>1);
        }else
        {
            $data = array('status'=>0);
        }
      $this->ajaxReturn($data,'json');
    }
    
   
    /*
    添加字段操作
    */
    public function addfield()
    {
        if(!IS_AJAX)
        {
            $this->error('页面不存在!');die;
        }
            $arr=I('field_array');

       if($arr['id'])
       {
              if($arr['default']=="")
            {
                unset($arr['default']);
                $result =M('field')->save($arr);
            }else
            {
                $result =M('field')->save($arr);
            }
        }else
        {
              if($arr['default']=="")
            {
                unset($arr['default']);
                $result =M('field')->add($arr);
            }else
            {
                $result =M('field')->add($arr);
            }
        }


        if($result)
        {
            $data = array('status'=>1);
        }else
        {
            $data = array('status'=>0);
        }
            $this->ajaxReturn($data,'json');
    }
     /*
    查询字段是否存在
     */
    public function checkfield()
    {
        if(!IS_AJAX)
        {
            $this->error('页面不存在!');die;
        }
            $arr= I('field_array ');

            $result = M('field')->where($arr)->select(); 

            if($result)
            {
                $data = array('status'=>1);
            }else
            {
                $data = array('status'=>0);
            }
            $this->ajaxReturn($data,'json');
    }

    /*
    删除字段操作
    */
    public function delete2()
    {
        if(!IS_AJAX)
        {
              $this->error('页面不存在!');die;
        }
              $arr =I('id');
              $result = M('table')->where(array('id'=>$arr))->detele();
     
       if($result)
        {
              $data = array('status'=>1);
        }else
        {
              $data = array('status'=>0);
        }
              $this->ajaxReturn($data,'json');

    }


    /*
    搜索功能
     */
    public function search()
    {       
        if(!IS_AJAX)
        {
            $this->error('页面不存在!');die;
        }
            $arr =I('table_array');
            $result = M('table')->where($arr)->select();
     
    }

    /*
    所有选中的表和字段
    */
   public function getsql()
   {
        if(!IS_AJAX)
        {
            $this->error('页面不存在!');die;
        }
        //查询选中的表
        $arr = I('table_array');
        /*array(
          1,2,3
          );*/
        $wh1 =array(
          'id'=>1,
          
          
          );
        $sql = M('table')->where($wh1)->select();

        foreach ($sql as $k => $va) {
          $wh2 =array(
              'table_id'=>$va['id']
            );
          $sql2 = M('field')->where($wh2)->select();
          foreach ($sql2 as $a => $c) {
            $wh3 = array(
              'id'=>$c['data_id']
              );
            $sql3 = M('datatype')->where($wh3)->getField('data_name');

            $c['data_name']=$sql3;
            $sql2[$a]=$c;
          }
          $va['aa']=$sql2;
          $sql[$k]=$va;
        }
       
        foreach ($sql as $b) {
          $result = 'create table'.' '.$b['name_en'] .'(';
            foreach ($va['aa'] as $d => $z) {
                $result .= 
                $z['field_en'].' '.
                $z['data_name'].'('.$z['leng'].') ';
               
                if($z['null']==0){
                  $result .=' null';
                }if($z['null']==1){
                  $result .=' not null ';
                }
                if($z['addself']==1){
                  $result .=' auto_increment ';
                }
                if($z['majorkey']==1){
                  $result .=' primary key ';
                }
                 if($z['default'] != ""){
                  $result .=' default '.$z['default'];
                }
                if(count($va['aa'])> ($d+1)) {
                  $result .= ', ';
                }
          
          }
          $result .= ');';
          }
      $this->ajaxReturn($result,'json');
    
  }





}