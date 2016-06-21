<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
    <head>
        <title>UIKIT DEMO</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/getsql/Public/css/uikit.min.css" />
        <script src="/getsql/Public/js/jquery.min.js"></script>
        <script src="/getsql/Public/js/uikit.min.js"></script>
        <script src="/getsql/Public/js/accordion.min.js"></script>
        <style type="text/css">
        	.tm-article-subtitle {
        		padding-left: 6px;
			    border-left: 3px solid #1FA2D6;
			    font-size: 16px;
			    line-height: 16px;
        	}
            .uk-accordion {
                width: 200px;
            }
            .uk-accordion-title {
                width: 100%;
                cursor: pointer;
                background-color: #F2F2F2;
                border-radius: 3px;
                padding: 8px 10px 8px 30px;
                position: relative;
            }
            .uk-accordion-title i {
                position: absolute;
                top: 10px;
                left: 10px;
            }
            .uk-accordion-content > p {
                cursor: pointer;
                background-color: rgba(242, 242, 242, 0.5);
                border-radius: 3px;
                padding: 5px 10px;
                margin-bottom: 3px;
                margin-top: 0px;
                color: #AFAFAF;
            }
            .generator {
                margin-top: 20px;
                width: 240px;
            }
            .generator a {
                width: 100%;
                padding: 5px 0px;
                border-radius: 3px;
            }
            #add_column form input {
                width: 250px;
            }
        </style>
    </head>
    <body>
    	<div class="uk-margin-large-top uk-margin-large-left uk-margin-large-right">
            <div class="uk-grid">
                <div class="uk-width-1-2">
                    <h2 class="uk-h2">数据表SQL生成器</h2>
                </div>
                <div class="uk-width-1-2 uk-position-relative">
                    <form class="uk-form uk-position-bottom-right">
                        <fieldset data-uk-margin>
                            应用类型：
                            <select>
                                <option>通用</option>
                                <option>通用</option>
                                <option>通用</option>
                            </select>
                            <input type="text" placeholder="输入表名">
                            <button class="uk-button"><i class="uk-icon-search"></i></button>
                            <a class="uk-button uk-button-primary" data-uk-modal="{target:'#add_table'}"><i class="uk-icon-plus"></i> 添加表</a>
                            <a class="uk-button uk-button-success" data-uk-modal="{target:'#add_column'}"><i class="uk-icon-plus"></i> 添字段</a>
                        </fieldset>
                    </form>
                </div>
            </div>
            <hr class="uk-article-divider">

            <div class="uk-grid">
                <div class="uk-width-8-10">
                    <!-- 表格01 -->
                    <table class="uk-table uk-margin-bottom-remove">
                        <tbody>
                            <tr>
                                <td width="80">
                                    <h3 class="uk-h3"><mark>用户表Users</mark> 
                                        <a class="uk-button uk-button-mini uk-button-primary" data-uk-modal="{target:'#add_table'}">
                                            <i class="uk-icon-pencil"></i></a>
                                        <a class="uk-button uk-button-mini uk-button-success" data-uk-modal="{target:'#trash_table'}">
                                            <i class="uk-icon-trash"></i></a>
                                    </h3>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="uk-overflow-container">
                        <table class="uk-table uk-table-striped">
                            <thead>
                                <tr>
                                    <th width="10"><input type="checkbox" onclick="checkbox(this)"></th>
                                    <th width="80">字段名称</th>
                                    <th width="80">数据类型</th>
                                    <th width="80">长度/值</th>
                                    <th width="80">默认值</th>
                                    <th width="80">是否为空</th>
                                    <th width="80">是否自增</th>
                                    <th width="80">主键</th>
                                    <th width="120">说明</th>
                                    <th width="60">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>id</td>
                                    <td>int</td>
                                    <td>11</td>
                                    <td>null</td>
                                    <td>否</td>
                                    <td>是</td>
                                    <td>是</td>
                                    <td>记录ID</td>
                                    <td>
                                        <a class="uk-button uk-button-mini uk-button-primary" data-uk-modal="{target:'#add_column'}">
                                            <i class="uk-icon-pencil"></i></a>
                                        <a class="uk-button uk-button-mini uk-button-success" data-uk-modal="{target:'#trash_column'}">
                                            <i class="uk-icon-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>id</td>
                                    <td>int</td>
                                    <td>11</td>
                                    <td>null</td>
                                    <td>否</td>
                                    <td>是</td>
                                    <td>是</td>
                                    <td>记录ID</td>
                                    <td>
                                        <a class="uk-button uk-button-mini uk-button-primary" data-uk-modal="{target:'#add_column'}">
                                            <i class="uk-icon-pencil"></i></a>
                                        <a class="uk-button uk-button-mini uk-button-success" data-uk-modal="{target:'#trash_column'}">
                                            <i class="uk-icon-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>id</td>
                                    <td>int</td>
                                    <td>11</td>
                                    <td>null</td>
                                    <td>否</td>
                                    <td>是</td>
                                    <td>是</td>
                                    <td>记录ID</td>
                                    <td>
                                        <a class="uk-button uk-button-mini uk-button-primary" data-uk-modal="{target:'#add_column'}">
                                            <i class="uk-icon-pencil"></i></a>
                                        <a class="uk-button uk-button-mini uk-button-success" data-uk-modal="{target:'#trash_column'}">
                                            <i class="uk-icon-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr class="uk-article-divider">
                    <!-- 表格01 -->


                    <!-- 表格02 -->
                    <table class="uk-table uk-margin-bottom-remove">
                        <tbody>
                            <tr>
                                <td width="80">
                                    <h3 class="uk-h3"><mark>角色表Role</mark> 
                                        <a class="uk-button uk-button-mini uk-button-primary" data-uk-modal="{target:'#add_table'}">
                                            <i class="uk-icon-pencil"></i></a>
                                        <a class="uk-button uk-button-mini uk-button-success" data-uk-modal="{target:'#trash_table'}">
                                            <i class="uk-icon-trash"></i></a>
                                    </h3>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="uk-overflow-container">
                        <table class="uk-table uk-table-striped">
                            <thead>
                                <tr>
                                    <th width="10"><input type="checkbox" onclick="checkbox(this)"></th>
                                    <th width="80">字段名称</th>
                                    <th width="80">数据类型</th>
                                    <th width="80">长度/值</th>
                                    <th width="80">默认值</th>
                                    <th width="80">是否为空</th>
                                    <th width="80">是否自增</th>
                                    <th width="80">主键</th>
                                    <th width="120">说明</th>
                                    <th width="60">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>id</td>
                                    <td>int</td>
                                    <td>11</td>
                                    <td>null</td>
                                    <td>否</td>
                                    <td>是</td>
                                    <td>是</td>
                                    <td>记录ID</td>
                                    <td>
                                        <a class="uk-button uk-button-mini uk-button-primary">
                                            <i class="uk-icon-pencil"></i></a>
                                        <a class="uk-button uk-button-mini uk-button-success">
                                            <i class="uk-icon-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>id</td>
                                    <td>int</td>
                                    <td>11</td>
                                    <td>null</td>
                                    <td>否</td>
                                    <td>是</td>
                                    <td>是</td>
                                    <td>记录ID</td>
                                    <td>
                                        <a class="uk-button uk-button-mini uk-button-primary">
                                            <i class="uk-icon-pencil"></i></a>
                                        <a class="uk-button uk-button-mini uk-button-success">
                                            <i class="uk-icon-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>id</td>
                                    <td>int</td>
                                    <td>11</td>
                                    <td>null</td>
                                    <td>否</td>
                                    <td>是</td>
                                    <td>是</td>
                                    <td>记录ID</td>
                                    <td>
                                        <a class="uk-button uk-button-mini uk-button-primary">
                                            <i class="uk-icon-pencil"></i></a>
                                        <a class="uk-button uk-button-mini uk-button-success">
                                            <i class="uk-icon-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr class="uk-article-divider">
                    <!-- 表格02 -->


                    <!-- 表格03 -->
                    <table class="uk-table uk-margin-bottom-remove">
                        <tbody>
                            <tr>
                                <td width="80">
                                    <h3 class="uk-h3"><mark>分类表Catelgo</mark> 
                                        <a class="uk-button uk-button-mini uk-button-primary" data-uk-modal="{target:'#add_table'}">
                                            <i class="uk-icon-pencil"></i></a>
                                        <a class="uk-button uk-button-mini uk-button-success" data-uk-modal="{target:'#trash_table'}">
                                            <i class="uk-icon-trash"></i></a>
                                    </h3>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="uk-overflow-container">
                        <table class="uk-table uk-table-striped">
                            <thead>
                                <tr>
                                    <th width="10"><input type="checkbox" onclick="checkbox(this)"></th>
                                    <th width="80">字段名称</th>
                                    <th width="80">数据类型</th>
                                    <th width="80">长度/值</th>
                                    <th width="80">默认值</th>
                                    <th width="80">是否为空</th>
                                    <th width="80">是否自增</th>
                                    <th width="80">主键</th>
                                    <th width="120">说明</th>
                                    <th width="60">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>id</td>
                                    <td>int</td>
                                    <td>11</td>
                                    <td>null</td>
                                    <td>否</td>
                                    <td>是</td>
                                    <td>是</td>
                                    <td>记录ID</td>
                                    <td>
                                        <a class="uk-button uk-button-mini uk-button-primary">
                                            <i class="uk-icon-pencil"></i></a>
                                        <a class="uk-button uk-button-mini uk-button-success">
                                            <i class="uk-icon-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>id</td>
                                    <td>int</td>
                                    <td>11</td>
                                    <td>null</td>
                                    <td>否</td>
                                    <td>是</td>
                                    <td>是</td>
                                    <td>记录ID</td>
                                    <td>
                                        <a class="uk-button uk-button-mini uk-button-primary">
                                            <i class="uk-icon-pencil"></i></a>
                                        <a class="uk-button uk-button-mini uk-button-success">
                                            <i class="uk-icon-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>id</td>
                                    <td>int</td>
                                    <td>11</td>
                                    <td>null</td>
                                    <td>否</td>
                                    <td>是</td>
                                    <td>是</td>
                                    <td>记录ID</td>
                                    <td>
                                        <a class="uk-button uk-button-mini uk-button-primary">
                                            <i class="uk-icon-pencil"></i></a>
                                        <a class="uk-button uk-button-mini uk-button-success">
                                            <i class="uk-icon-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr class="uk-article-divider">
                    <!-- 表格03 -->
                </div>

                <div class="uk-width-2-10">
                    <div class="uk-grid">
                        <p class="uk-margin-bottom">您选择的表格和字段：</p>
                        <div class="uk-accordion" data-uk-accordion="{collapse: false, showfirst: false}">
                            <h4 class="uk-accordion-title uk-margin-small uk-h4" status="0">
                                <i class="uk-icon-caret-right"></i> 用户表Users</h4>
                            <div data-wrapper="true" style="height: 0px; position: relative; overflow: hidden;" aria-expanded="false"><div class="uk-accordion-content">
                                <p>1. id-用户ID</p>
                                <p>2. photo-用户头像</p>
                            </div></div>

                            <h4 class="uk-accordion-title uk-margin-small uk-h4" status="0">
                                <i class="uk-icon-caret-right"></i> 用户表Users</h4>
                            <div data-wrapper="true" style="height: 0px; position: relative; overflow: hidden;" aria-expanded="false"><div class="uk-accordion-content">
                                <p>1. id-用户ID</p>
                                <p>2. photo-用户头像</p>
                            </div></div>

                            <h4 class="uk-accordion-title uk-margin-small uk-h4" status="0">
                                <i class="uk-icon-caret-right"></i> 用户表Users</h4>
                            <div data-wrapper="true" style="overflow:hidden;height:0;position:relative;" aria-expanded="false"><div class="uk-accordion-content">
                                <p>1. id-用户ID</p>
                                <p>2. photo-用户头像</p>
                            </div></div>
                        </div>
                        <p class="generator"><a class="uk-button uk-button-danger">生存SQL</a></p>
                    </div>
                </div>
            </div>

            <div class="uk-grid">
                <p>Copy Right &copy; PHOCUS 2015-2016 All Rights Reserved.</p>
            </div>
    	</div>


        <!-- 删除字段 -->
        <div id="trash_column" class="uk-modal">
            <div class="uk-modal-dialog" style="width:400px">
                <button type="button" class="uk-modal-close uk-close"></button>
                <div class="uk-modal-header">
                    <h2>删除字段</h2>
                </div>
                <p>对象：用户表Users &gt; photo-用户头像</p>
                <p>删除后不可恢复，确认进行此操作吗？</p>
                <div class="uk-modal-footer uk-text-right">
                    <button type="button" class="uk-button uk-modal-close">取消</button>
                    <button type="button" class="uk-button uk-button-primary uk-modal-close" onclick="successAlert()">确认</button>
                </div>
            </div>
        </div>


        <!-- 删除表 -->
        <div id="trash_table" class="uk-modal">
            <div class="uk-modal-dialog" style="width:400px">
                <button type="button" class="uk-modal-close uk-close"></button>
                <div class="uk-modal-header">
                    <h2>删除表</h2>
                </div>
                <p>对象：用户表Users</p>
                <p>删除后不可恢复，确认进行此操作吗？</p>
                <div class="uk-modal-footer uk-text-right">
                    <button type="button" class="uk-button uk-modal-close">取消</button>
                    <button type="button" class="uk-button uk-button-primary uk-modal-close">确认</button>
                </div>
            </div>
        </div>


        <!-- 添加／编辑表 -->
        <div id="add_table" class="uk-modal">
            <div class="uk-modal-dialog" style="width:400px">
                <button type="button" class="uk-modal-close uk-close"></button>
                <div class="uk-modal-header">
                    <h2>添加／编辑表</h2>
                </div>
                
                <form class="uk-form">
                    <fieldset>
                        <div class="uk-form-row">
                            英文名称：<input type="text" placeholder="">
                        </div>
                        <div class="uk-form-row">
                            中文名称：<input type="text" placeholder="">
                        </div>
                        <div class="uk-form-row">
                            选择分类：
                            <select style="width:150px;">
                                <option>通用</option>
                                <option>电子商务</option>
                                <option>在线教育</option>
                                <option>旅游社交</option>
                                <option>互联网金融</option>
                                <option>体育健身</option>
                                <option>教育培训</option>
                            </select>
                        </div>
                        
                    </fieldset>
                </form>


                <div class="uk-modal-footer uk-text-right">
                    <button type="button" class="uk-button uk-modal-close">取消</button>
                    <button type="button" class="uk-button uk-button-primary uk-modal-close">确认</button>
                </div>
            </div>
        </div>


        <!-- 添加／编辑字段 -->
        <div id="add_column" class="uk-modal">
            <div class="uk-modal-dialog" style="width:400px">
                <button type="button" class="uk-modal-close uk-close"></button>
                <div class="uk-modal-header">
                    <h2>添加／编辑字段</h2>
                </div>
                
                <form class="uk-form">
                    <fieldset>
                        <div class="uk-form-row">
                            请选择表：
                            <select style="width:150px;">
                                <option>用户表Users</option>
                                <option>角色表Role</option>
                            </select>
                        </div>
                        <div class="uk-form-row">
                            英文名称：<input type="text" placeholder="">
                        </div>
                        <div class="uk-form-row">
                            中文名称：<input type="text" placeholder="">
                        </div>
                        <div class="uk-form-row">
                            数据类型：
                            <select style="width:150px;">
                                <option>int－数字</option>
                                <option>text－文本</option>
                            </select>
                        </div>
                        <div class="uk-form-row">
                            字段长度：<input type="text" placeholder="">
                        </div>
                        <div class="uk-form-row">
                            设置默认：<input type="text" placeholder="">
                        </div>
                        <div class="uk-form-row">
                            是否为空
                            <select style="width:150px;">
                                <option>是</option>
                                <option>否</option>
                            </select>
                        </div>
                        <div class="uk-form-row">
                            是否自增
                            <select style="width:150px;">
                                <option>是</option>
                                <option>否</option>
                            </select>
                        </div>
                        <div class="uk-form-row">
                            是否主键
                            <select style="width:150px;">
                                <option>是</option>
                                <option>否</option>
                            </select>
                        </div>
                        <div class="uk-form-row" v-model="v1">
                            字段说明：<input type="text" placeholder="">
                        </div>
                    </fieldset>
                </form>

                <div class="uk-modal-footer uk-text-right">
                    <button type="button" class="uk-button uk-modal-close">取消</button>
                    <button type="button" class="uk-button uk-button-primary uk-modal-close">确认</button>
                </div>
            </div>
        </div>



        <script type="text/javascript">
            $(document).ready(function(){
                $(".uk-accordion-title").click(function(){
                    var status = $(this).attr("status")*1;
                    if(status === 0){
                        $(this).find("i").removeClass("uk-icon-caret-right").addClass("uk-icon-caret-down");
                        $(this).attr("status", 1);
                    }
                    if(status === 1){
                        $(this).find("i").removeClass("uk-icon-caret-down").addClass("uk-icon-caret-right");
                        $(this).attr("status", 0);
                    }
                });
            });
            function checkbox(_this){
                    var checkstatus = $(_this).attr('data-check') * 1;
                    if (checkstatus) {
                        $(_this).parents("table").find("tbody").find("input[type=checkbox]").prop('checked', false);
                        $(_this).attr('data-check', 0);
                    } else {
                        $(_this).parents("table").find("tbody").find("input[type=checkbox]").prop('checked', true);
                        $(_this).attr('data-check', 1);
                    }
                }
        </script>
    </body>
</html>