<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller 
{   
    public function _initialize(){
        if(!session('user')) {
            if (IS_AJAX) {
                $user = I('username');
                $pass = I('password');
                $arr = array(
                    'username'=>$user,
                    'password'=>$pass
                );
                //p($arr);
                $result = M('users')->where($arr)->select();
                if($result){
                    $data = array('status'=>1);
                    session('user', $result);
                } else {
                    $data = array('status'=>0);
                }
                $this->ajaxReturn($data,'json');
            } else {
                $this->display("login"); die;  

            }
        }
     }
    public function tuichu(){
        session_start();
        session_unset();
        session_destroy();
        $this->redirect('Index/index',3000);
    }

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
            $type_id = '';
        }
        //判断应用类型id,赋值
        if ($type_id && !$key) {
            $arr['apply_id'] = $type_id;
        }
        /* 分配到页面 */
        $this->type_id = $type_id;
        $this->seek = $key;
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
            'name_zh'   =>I(name_zh),
            'name_en'   =>I(name_en),
            'apply_id'  =>I(apply_id)
        );
        //判断是修改还是添加操作
        $arr2 = array(
            //'name_zh'   =>I(name_zh),
            'name_en'   =>I(name_en),
        );
        $result = M('table')->where($arr2)->select(); 
        if($result){
            $data = array('status'=>2);
            $this->ajaxReturn($data,'json');
        }else{     
            if(I('id')){
                $arr['id']=I('id');
                $result = M('table')->save($arr);
            }else{
                $result = M('table')->add($arr);
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
     点击修改获取表的默认显示值
     */
    public function pulltable()
    {
        if(!IS_AJAX){
            $this->error('页面不存在!');die;
        }
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

        } else {
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
            
            'field_en'  =>I('field_en'),
            //'apply_id'  =>I('apply_id'),
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
        if(I('id'))
        {     
            //判断有无默认值
            if($arr['default']==""){
                unset($arr['default']);
                $arr['id']=I('id');
                $result =M('field')->save($arr);
            }else{
                $arr['id']=I('id');
                $result =M('field')->save($arr);
            }
        }else{     
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
     点击修改获取表的默认显示值
     */
      public function pullfield()
    {
        $result = M('field')->where(array('id' => I('id')))->find();
        if($result){
            $data = array(
                'id'        =>$result['id'],
                'field_en'  =>$result['field_en'],
                'leng'      =>$result['leng'],
                'null'      =>$result['null'],
                'default'   =>$result['default'],
                'table_id'  =>$result['table_id'],
                'data_id'   =>$result['data_id'],
                'explain'   =>$result['explain'],
                'addself'   =>$result['addself'],
                'majorkey'  =>$result['majorkey']
            );
            $arr = array(
                'status' => 1,
                'result' => $data
            );
        } else {
            $arr = array('status' => 0);
        }
        $this->ajaxReturn($arr,'json');
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
        $arr=I('id');
        //获取字段id
        $wh1['id'] =array('in',$arr);
        $sql1 =M('field')->where($wh1)->select();
        foreach ($sql1 as $k1 => $v1) {
            //以table_id 查询表id
            $wh['id'] =array('in',$v1['table_id']);
            $sql = M('table')->where($wh)->field('name_en,name_zh')->find();
            //以data_id 查询类型id
            $wh3 = array(
              'id' =>$v1['data_id']
            );
            $sql3 = M('datatype')->where($wh3)->getField('data_name');
            //赋值
            $v1['data_name']=$sql3;
            $sql1[$k1]=$v1;
            $v1['name_en']=$sql['name_en'];
            $v1['name_zh']=$sql['name_zh'];
            $sql1[$k1]=$v1;
        }
        //$sql1中name_en字段分组，重复的
        $table = array();
        $table_name = array();
        foreach ($sql1 as $k => $v) 
        {
            if(!$k){
                /* 默认开始表ID */
                $table_id = $v['table_id'];
                /* 表名备注 */
                $table_name[$v['name_en']] = $v['name_zh'];
            }

            if($table_id == $v['table_id']) {
                /* 相同表追加 */
                $table[$v['name_en']][] = $v;
            } else {
                /* 重新赋值表ID */
                $table_id = $v['table_id'];
                /* 不同表新建 */
                $table[$v['name_en']][] = $v;
                /* 表名备注 */
                $table_name[$v['name_en']] = $v['name_zh'];
            }

        }

        //生成sql 语句
        $result = '';
        foreach ($table as $ke => $va) 
        {
            /* 表名称 */
            $result .= 'create table '.$ke.'(';
            foreach ($va as $k => $v) 
            {
                /* 字段名/类型 */
                $result .= $v['field_en'].' '.$v['data_name'];
                /* 字段长度 */
                if ($v['leng']) {
                    $result .= '('.$v['leng'].')';
                }
                /* 主键 */
                if($v['majorkey'])
                {
                    $result .= ' primary key';
                }
                /* 自增 */
                if($v['addself'])
                {
                    $result .= ' auto_increment';
                }
                /* 默认值 */
                if($v['default'])
                {
                   $result .= ' default '.$v['default'];
                } else {
                    /* 是否为空 */
                    if($v['null'])
                    {
                        /* 默认值 */
                        $result .= ' default';
                        /* 是否为空 */
                        $result .= ' null';
                    } else {
                        $result .= ' not null';
                    }
                }
                /* 字段注释 */
                if ($v['explain']) {
                    $result .= " comment '".$v['explain']."'";
                }
                if(count($va)> ($k+1))
                {
                    $result .= ',';
                }

            }
            $result .= ") comment '".$table_name[$ke]."';";
        }
        $this->ajaxReturn($result,'json');
    }




}