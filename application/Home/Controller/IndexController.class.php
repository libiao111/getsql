<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller 
{
    public function index()
    {
        /* 筛选条件 */
        $type_id = I('type_id');
        $key = I('key');
        $arr = array();
        //判断输入框的值是英文还是中文
        if ($key) {
            $arr[] = array(
                '_logic' => 'or',
                'name_zh' => array( 'like','%'.$key.'%' ),
                'name_en' => array( 'like','%'.$key.'%' )
            );
        }
        //判断应用类型id,赋值
        if ($type_id) {
            $arr['apply_id'] = $type_id;
            
        }
        /* 分配到页面 */
        $this->type_id = $type_id;
        $this->key = $key;

        /* 查询数据类型 */
        $datatype = M('datatype')->select();
        $this->assign('dat',$datatype);

        /* 查询表的应用类型 */
   		  $apptype = M('apply')->select();
        $this->assign('apply',$apptype);
        /* 查询表名 */
        $tablename = M('table')->where($arr)->select();
        foreach ($tablename as $key => $v) {
            /* 以表名id关联查询field表 */
            $where = array(
                'table_id'=>$v['id']
            );
            $arr2 = M('field')->where($where)->select();
            foreach ($arr2 as $k => $va) {
                /* 以field的表data_id关联查询字段类型 */
                $where1 = array( 'id'=>$va['data_id'] );
                $arr3 = M('datatype')->where($where1)->getField('data_name');
                //赋值
                $va['data_name']=$arr3;
                $arr2[$k]=$va;
            }
            //赋值
            $v['bb'] =$arr2;
            $tablename[$key]=$v;
        }
        $this->assign('table',$tablename);
        $this->display();	
    }
	 
   /*
   添加表操作 和修改表操作
   */
  
    public function addtable()
    {
        if(!IS_AJAX){
      		  $this->error('页面不存在!');die; 
      	}
        //获取信息
      	$arr = array(  
            'id'        =>I('id'),
            'name_zh'   =>I(name_zh),
            'name_en'   =>I(name_en),
            'apply_id'  =>I(apply_id)
          );
        
          //判断是修改还是添加操作
        if($arr['id']){
            $result = M('table')->save($arr);
        }else{
            unset($arr['id']);
            $result = M('table')->add($arr);
        }
      	if($result){
        		$data = array('status'=>1);
      	}else{
        		$data = array('status'=>0);
      	}
        	  $this->ajaxReturn($data,'json');
    }
     /*
     点击修改获取默认显示值
     */
      public function pulltable()
    {
        $result = M('table')->where(array('id' => I('id')))->find();
        if($result){
            $data = array(
                'id'   =>$result['id'],
                'name_en' =>$result['name_en'],
                'name_zh' =>$result['name_zh'],
                'apply_id'=>$result['apply_id']
            );
            $arr = array(
                'status' => 1,
                'result' => $data
            );

        } else{
            $arr = array('status' => 0);
        }
        $this->ajaxReturn($arr,'json');
    }
    /*
    删除表操作
     */
    public function delete1()
    {
        if(!IS_AJAX){
            $this->error('页面不存在!');die;
        }
            //先删除字段
            $arr =I('id');
            $sql = M('field')->where(array('table_id'=>$arr))->delete();
        if($sql){   
        //删除表
            $result = M('table')->where(array('id'=>$arr))->delete();

        }else{
          //无字段直接删除表
            $result = M('table')->where(array('id'=>$arr))->delete();
        }
        if($result){
            $data = array('status'=>1);
        }else{
            $data = array('status'=>0);
        }
            $this->ajaxReturn($data,'json');
    }

    /*
    查询表是否存在
     */
    public function checktable()
    {
        if(!IS_AJAX){
            $this->error('页面不存在!');die;
        }
            //获取表名
            $arr= I('name');
            //筛选是中文还是英文表名
            $where = array(
                    'name_en'   =>$arr,
                    'name_zh'   =>$arr,
                    '_logic'     =>'or'
              );
            $result = M('table')->where($where)->select(); 
        if($result){
            $data = array('status'=>1);
        }else{
            $data = array('status'=>0);
        }
      $this->ajaxReturn($data,'json');
    }
    
   
    /*
    添加字段 和修改操作
    */
    public function addfield()
    {
        if(!IS_AJAX){
            $this->error('页面不存在!');die;
        }   
        $arr=array(
            'id'       =>I('id'),
            'field_en'  =>I('field_en'),
            'apply_id'  =>I('apply_id'),
            'leng'      =>I('leng'),
            'default'   =>I('default'),
            'addself'   =>I('addself'),
            'majorkey'  =>I('majorkey'),
            'explain'   =>I('explain'),
            'data_id'   =>I('data_id'),
            'null'      =>I('null'),
            'table_id'  =>I('table_id')
          );
            // 判断是修改还是添加操作
        if($arr['id'])
       {     
           //判断有无默认值
            if($arr['default']==""){
                unset($arr['default']);
                $result =M('field')->save($arr);
            }else{
                $result =M('field')->save($arr);
            }
        }else{     
                //移除数组中的id
                unset($arr['id']);
                //判断有无默认值
            if($arr['default']==""){
                unset($arr['default']);
                $result =M('field')->add($arr);
            }else{
                $result =M('field')->add($arr);
            }
        }
        if($result){
              $data = array('status'=>1);
          }else{
              $data = array('status'=>0);
          }
              $this->ajaxReturn($data,'json');
    }
     /*
    查询字段是否存在
     */
    public function checkfield()
    {
        if(!IS_AJAX) {
            $this->error('页面不存在!');die;
        }
            //获取信息
            $arr= array ( 
    
                  'field_en'  =>I('field_en'),
                  'table_id'  =>I('table_id')
            );
            //查询字段
            $result = M('field')->where($arr)->select(); 

        if($result) {
            $data = array('status'=>1);
        } else {
            $data = array('status'=>0);
        }
            $this->ajaxReturn($data,'json');
    }

    /*
    删除字段操作
    */
    public function delete2()
    {
        if(!IS_AJAX) {
            $this->error('页面不存在!');die;
        }
            //获取字段id
            $arr =I('id');
            //删除字段
            $result = M('field')->where(array('id'=>$arr))->delete();
     
        if($result) {
            $data = array('status'=>1);
        } else {
            $data = array('status'=>0);
        }
            $this->ajaxReturn($data,'json');

    }


    /*
    所有选中的表和字段获取sql语句
    */
    public function getsql()
    {
        if(!IS_AJAX){
            $this->error('页面不存在!');die;
        }
        //查询选中的表
        $arr=I('id');
        //获取字段id
        $wh1['id'] =array('in',$arr);
        $sql1 =M('field')->where($wh1)->order('table_id')->select();
        foreach ($sql1 as $k1 => $v1) {
            //以table_id 查询表id
            $wh['id'] =array('in',$v1['table_id']);
            $sql = M('table')->where($wh)->getField('name_en');
            //以data_id 查询类型id
            $wh3 = array(
              'id' =>$v1['data_id']
              );
            $sql3 = M('datatype')->where($wh3)->getField('data_name');
            //赋值
            $v1['data_name']=$sql3;
            $sql1[$k1]=$v1;

            $v1['name_en']=$sql;
            $sql1[$k1]=$v1;
        }
        //$sql1中name_en字段分组，重复的
        $table = array();
        foreach ($sql1 as $k => $v) 
        {

            if (!$k) 
            {
                $table_id = $v['table_id'];
            }
            if ($table_id == $v['table_id']) 
            {
                $table[$v['name_en']][] = $v;
            } else 
            {
                $table_id = $v['table_id'];
                $table[$v['name_en']][] = $v;
            }
      }
      //生成sql 语句
      foreach ($table as $ke => $va) 
      {
              $result .= 'create table'.' '.$ke.$va['name_en'] .'( ';
          foreach ($va as $k => $v) 
          {
              $result .=$v['field_en'].' '.$v['data_name'].'('.$v['leng'].') ';
              if($v['null']==0)
              {
                      $result .=' null';
              }if($v['null']==1)
              {
                      $result .=' not null ';
              }
              if($v['addself']==1)
              {
                      $result .=' auto_increment ';
              }
              if($v['majorkey']==1)
              {
                      $result .=' primary key ';
              }
               if($v['default'] != "")
              {
                      $result .=' default '.$v['default'];
              }
              if(count($va)> ($k+1)) 
              {
                      $result .= ', ';
              }
              
          }
                      $result .= ');';

      }
        $this->ajaxReturn($result,'json');
    }




}