

<!-- [数据表应用类型] -->
1、接口类型 => 数据输出；
2、功能描述 => 获取数据表应用类型，显示在应用类型下拉菜单；
3、请求方式 => 无；
4、请求参数 => 无；
5、返回数据 => 数组，结构如下：
	apply
	   {
	   	 [v] => [id][apply_name]
	   }
6、使用方法 => <foreach>循环；




<!-- [添加或修改table表记录] -->
1、接口类型 => 数据写入；
2、功能描述 => 创建新数据表；
3、请求方式 =>方法：post；路径：addtable
4、请求参数 => 
	数组名称：table_array
	{	
		id			=>value	表的id
		name_zh 	=>value 中文名称；
		name_en 	=>value 英文名称；
	 	apply_id	=>value 应用类型；
	}
		有id键 修改操作
		没id键 添加操作
5、返回数据 => 数组，结构如下：
	data
	{
		status => value 
	}
	value = 1 插入成功
	value = 0 插入失败


<!-- [删除表操作] -->
1、接口类型 => 数据删除；
2、功能描述 => 删除数据表记录；
3、请求方式 =>方法：post；路径：delete1
4、请求参数 => 
	数组名称：table_array

	{	
		id			=>value	表的id
		
	}
5、返回数据 => 数组，结构如下：
	data
	{
		status => value 
	}
	value = 1 删除成功
	value = 0 删除失败
<!-- [添加field字段] -->

1、接口类型 => 数据写入；
2、功能描述 => 给field表添加新数据；
3、请求方式 =>方法：post；路径：addfield
4、请求参数 => 
	数组名称：field_array
	{
		id			=>value	字段id
		field_en 	=>value 英文名称；
	 	apply_id	=>value 应用类型；
	 	leng		=>value 长度/值；
	 	default		=>value	默认值；
	 	addself		=>value 是否自增；
	 	majorkey	=>value 是否有主键；
	 	explain		=>value 说明；
		data_id		=>value 字段类型；
		null		=>value 是否为空；
	}
		有id键 修改操作
		没id键 添加操作
5、返回数据 => 数组，结构如下：
	data
	{
		status => value 
	}
	value = 1 插入成功
	value = 0 插入失败


<!-- [查询field字段] -->

1、接口类型 => 数据查询；
2、功能描述 => 查询字段是否存在；
3、请求方式 =>方法：post；路径：checkfield
4、请求参数 => 
	数组名称：field_array
	{
		
		field_en 	=>value 英文名称；
	 	table_id 	=>value 表id;
	}

5、返回数据 => 数组，结构如下：
	data
	{
		status => value 
	}
	value = 1 表中字段已存在
	value = 0 修改成功



<!-- [删除字段操作] -->
1、接口类型 => 数据删除；
2、功能描述 => 删除字段；
3、请求方式 =>方法：post；路径：delete2
4、请求参数 => 
	数组名称：table_array

	{	
		id			=>value	字段id
		
	}
5、返回数据 => 数组，结构如下：
	data
	{
		status => value 
	}
	value = 1 删除成功
	value = 0 删除失败


<!-- [删除字段操作] -->
1、接口类型 => 数据查询；
2、功能描述 => 查询表；
3、请求方式 =>方法：post；路径：search
4、请求参数 => 
	数组名称：table_array

	{	
		id			=>value	字段id
		apply_id	=>value	应用类型id
		
	}
5、返回数据 => 数组，结构如下：
	data
	{
		status => value 
	}
	value = 1 查询成功
	value = 0 查询失败


<!-- [生成sql语句操作] -->
1、接口类型 => 数据查询；
2、功能描述 => 查询表；
3、请求方式 =>方法：post；路径：getsql
4、请求参数 => 
	数组名称：table_array

	{	
		id			=>value	表id
	}
	数组名称：field_array

	{	
		id			=>value	字段id
	}
5、返回数据 => 数组，结构如下：
	data
	{
		$result => value 
	}