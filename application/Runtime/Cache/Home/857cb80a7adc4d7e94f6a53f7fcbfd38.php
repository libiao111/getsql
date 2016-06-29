<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <title>UIKIT DEMO</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/getsql/Public/css/uikit.min.css" />
    <link rel="stylesheet" href="/getsql/Public/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/getsql/Public/css/index.css" />
    <script src="/getsql/Public/js/jquery.min.js"></script>
    <script src="/getsql/Public/js/uikit.min.js"></script>
    <script src="/getsql/Public/js/accordion.min.js"></script>
</head>

<body>

    <div class="modal">
        <div class="back"></div>
        <div class="m-main">
            <h2>您选择的语句生成如下：</h2>
            <p id="tarcopy"></p>
            <button onclick="copy('tarcopy')" id="copy">复制</button>
        </div>
    </div>

    <div class="modal1">
        <div class="back"></div>
        <div class="m-main">
            <h2>success!</h2>
        </div>
    </div>


    <div class=" uk-margin-large-left uk-margin-large-right" style="padding-top: 50px;">

        <!-- 筛选查询 -->
        <div class="uk-grid">
            <div class="uk-width-1-2">
                <h2 class="uk-h2">数据表SQL生成器</h2>
            </div>
            <div class="uk-width-1-2 uk-position-relative">
                <form name="frm" class="uk-form uk-position-bottom-right" action="<?php echo U('index');?>" method="get" enctype="multipart/form-data">
                    <fieldset data-uk-margin>
                        应用类型：
                        <select id="sel" name="type_id">
                            <option value="">全部</option>
                            <?php if(is_array($apply)): foreach($apply as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>" <?php if($type_id == $val['id']): ?>selected<?php endif; ?>><?php echo ($val["apply_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                        <input type="text" placeholder="输入表名" id="search" value="<?php echo ($seek); ?>" name="key">
                        <button class="uk-button search"><i class="uk-icon-search"></i></button>
                        <a class="uk-button uk-button-primary sky" data-uk-modal="{target:'#add_table'}"><i class="uk-icon-plus"></i> 添加表</a>
                        <a class="uk-button uk-button-primary" href="<?php echo U('tuichu');?>">退出登录</a>
                    </fieldset>
                </form>
            </div>
        </div>
        <hr class="uk-article-divider">

        <!-- 列表 -->
        <div class="uk-grid">
            <div class="uk-width-8-10">
                <!-- 表格01 -->
                <?php if(is_array($table)): foreach($table as $key=>$v): ?><div class="tables-box">
                        <table class="uk-table uk-margin-bottom-remove" id="del_tab">
                            <tbody>
                                <tr>
                                    <td width="80">
                                        <h3 class="uk-h3">
                                        <mark name="<?php echo ($v["name_en"]); ?>" id="<?php echo ($v["id"]); ?>"><?php echo ($v["name_zh"]); echo ($v["name_en"]); ?></mark>
                                        <input class = "test" type ="text" style="display:none" value="<?php echo ($v["id"]); ?>">
                                        <a class="uk-button uk-button-mini uk-button-primary modify" data-uk-modal="{target:'#add_table'}">
                                            <i class="uk-icon-pencil"></i></a>
                                        <a class="uk-button uk-button-mini uk-button-success del_col1" data-uk-modal="{target:'#trash_table'}" >
                                            <i class="uk-icon-trash"></i></a>
                                        <a class="uk-button uk-button-success sky1" data-uk-modal="{target:'#add_column'}"><i class="uk-icon-plus"></i> 添字段</a>
                                    </h3>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="uk-overflow-container">
                            <table class="uk-table uk-table-striped">
                                <thead>
                                    <tr>
                                        <th width="10">
                                            <input type="checkbox" onclick="checkbox(this)">
                                        </th>
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
                                    <?php if(is_array($v["bb"])): foreach($v["bb"] as $key=>$zd): ?><tr>
                                            <td>
                                                <input type="checkbox" id="<?php echo ($zd["id"]); ?>" name="zd" value="<?php echo ($zd["id"]); ?>">
                                            </td>
                                            <td><?php echo ($zd["field_en"]); ?></td>
                                            <td><?php echo ($zd["data_name"]); ?></td>
                                            <td>
                                                <?php if($zd['leng']): echo ($zd["leng"]); ?>
                                                    <?php else: ?>-<?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($zd['default']): echo ($zd["default"]); ?>
                                                    <?php else: ?>null<?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($zd['null']): ?>null
                                                    <?php else: ?>not null<?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($zd['addself']): ?>自增
                                                    <?php else: ?>-<?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($zd['majorkey']): ?>主键
                                                    <?php else: ?>-<?php endif; ?>
                                            </td>
                                            <td><?php echo ($zd["explain"]); ?></td>
                                            <td>
                                                <a class="uk-button uk-button-mini uk-button-primary modify1" data-uk-modal="{target:'#add_column'}">
                                                    <i class="uk-icon-pencil"></i></a>
                                                <a class="uk-button uk-button-mini uk-button-success del_col" data-uk-modal="{target:'#trash_column'}">
                                                    <i class="uk-icon-trash"></i></a>

                                            </td>
                                        </tr><?php endforeach; endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <hr class="uk-article-divider">
                        <!-- 表格01 -->
                    </div><?php endforeach; endif; ?>
            </div>

            <div class="uk-width-2-10">
                <div class="uk-grid right">
                    <p class="uk-margin-bottom">您选择的表格和字段：</p>
                    <div id="join-table-list" class="uk-accordion">
                        <!-- loading -->
                    </div>
                    <p class="generator"><a class="uk-button uk-button-danger" id="save_sql">生存SQL</a></p>
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
                <button type="button" class="uk-button uk-button-primary uk-modal-close del_col3" onclick="successAlert()" id="del_col2">确认</button>
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
                <button type="button" class="uk-button uk-button-primary uk-modal-close del_col2">确认</button>
            </div>
        </div>
    </div>


    <div id="alert" class="uk-modal">
        <h2>操作成功</h2>
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
                        英文名称：
                        <input type="text" id="tname_en"><i class="fa fa-check-circle s" aria-hidden="true" style="color:green;margin-left:25px;display: none;"></i>
                        <i class="fa fa-exclamation f" aria-hidden="true" style="color:red;margin-left:25px;display: none;"></i>

                    </div>
                    <div class="uk-form-row">
                        中文名称：
                        <input type="text" id="tname_zh"><i class="fa fa-check-circle s" aria-hidden="true" style="color:green;margin-left:25px;display: none;"></i>
                        <i class="fa fa-exclamation f" aria-hidden="true" style="color:red;margin-left:25px;display: none;"></i>
                    </div>
                    <div class="uk-form-row">
                        选择分类：
                        <select style="width:150px;" id="tapply_id">
                            <?php if(is_array($apply)): foreach($apply as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>">
                                    <?php echo ($val["apply_name"]); ?>
                                </option><?php endforeach; endif; ?>
                        </select>
                    </div>
                </fieldset>
            </form>
            <div class="uk-modal-footer uk-text-right">
                <button type="button" class="uk-button uk-modal-close ">取消</button>
                <button type="button" class="uk-button uk-button-primary uk-modal-close " id="add_tab">确认</button>
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
                        <select style="width:150px;" id="table_id">
                            <?php if(is_array($table)): foreach($table as $key=>$tab): ?><option value="<?php echo ($tab["id"]); ?>"><?php echo ($tab["name_zh"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div class="uk-form-row">
                        英文名称：
                        <input type="text" placeholder="" id="fname_en">
                        <i class="fa fa-check-circle s" aria-hidden="true" style="color:green;margin-left:15px;display: none;"></i>
                        <i class="fa fa-exclamation f" aria-hidden="true" style="color:red;margin-left:15px;display: none;"></i>
                    </div>
                    <div class="uk-form-row">
                        数据类型：
                        <select style="width:150px;" id="fdata_id">
                            <?php if(is_array($dat)): foreach($dat as $key=>$type): ?><option value="<?php echo ($type["id"]); ?>"><?php echo ($type["data_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div class="uk-form-row">
                        字段长度：
                        <input type="text" placeholder="" id="fleng">
                    </div>
                    <div class="uk-form-row">
                        设置默认：
                        <input type="text" placeholder="" id="fdefault">
                    </div>
                    <div class="uk-form-row">
                        是否为空：
                        <select style="width:150px;" id="fnull">
                            <option id="fnull_t" value="1">是</option>
                            <option id="fnull-f" value="0">否</option>
                        </select>
                    </div>
                    <div class="uk-form-row">
                        是否自增：
                        <select style="width:150px;" id="fincre">
                            <option id="fincre_t" value="1">是</option>
                            <option id="fincre_f" value="0">否</option>
                        </select>
                    </div>
                    <div class="uk-form-row">
                        是否主键：
                        <select style="width:150px;" id="fprimarykey">
                            <option id="fprimarykey_t" value="1">是</option>
                            <option id="fprimarykey_f" value="0">否</option>
                        </select>
                    </div>
                    <div class="uk-form-row">
                        字段说明：
                        <input type="text" placeholder="" id="fexplain">
                    </div>
                </fieldset>
            </form>
            <div class="uk-modal-footer uk-text-right">
                <button type="button" class="uk-button uk-modal-close ">取消</button>
                <button type="button" class="uk-button uk-button-primary uk-modal-close" id="add_field">确认</button>
            </div>
        </div>
    </div>

    <!-- 克隆插入 -->
    <div id="clone" style="display:none">
        <div class="clone-box">
            <h4 class="uk-accordion-title uk-margin-small uk-h4" status="0">
                <i class="uk-icon-caret-right"></i> 用户表Users
            </h4>
            <div style="display: none;">
                <div class="uk-accordion-content">
                    <!-- loading -->
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function () {
            "use strict";
            let objTable = $('.tables-box');
            objTable.find('input[type="checkbox"]').click(function () {
                let _this = $(this),
                    obj = _this.parents('div.tables-box');
                addDiv(obj);
            });
            function addDiv(obj) {
                /* 选择选中多选框 */
                let vals = obj.find('input[name="zd"]:checked'),
                    tableName = obj.find('mark').attr('name');
                /* 删除已插入的列表 */
                $('#join-table-list').find('h4[data-name="' + tableName + '"]').parent('div.clone-box').remove();
                /* 加入选中表(字段) */
                if (vals.length) {
                    let htm = $('#clone .clone-box').clone(),
                        tit = obj.find('mark').text();
                    htm.find('h4').html('<i class="uk-icon-caret-right"></i> ' + tit);
                    htm.find('h4').attr('data-name', tableName);
                    for (let i = 0; i < vals.length; i++) {
                        let tr = vals.eq(i).parents('tr'),
                            en = tr.find('td').eq(1).text(),
                            zh = tr.find('td').eq(8).text();
                        htm.find('div.uk-accordion-content').append('<p>' + (i + 1) + '. ' + en + '-' + zh + '</p>');
                    };
                    $('#join-table-list').prepend(htm);
                    /* 绑定事件 */
                    htm.find('h4').click(function () {
                        let _this = $(this);
                        _this.next('div').slideToggle();
                    });
                }
            }
            // var objTable = $('.tables-box');
            // objTable.find('input[type="checkbox"]').click(function () {
            //     var _this = $(this);
            //     var obj = _this.parents('div.tables-box');
            //     addDiv(obj);
            // });
            // function addDiv(obj) {
            //     /* 选择选中多选框 */
            //     var vals = obj.find('input[name="zd"]:checked');
            //     var tableName = obj.find('mark').attr('name');
            //     /* 删除已插入的列表 */
            //     $('#join-table-list').find('h4[data-name="' + tableName + '"]').parent('div.clone-box').remove();
            //     /* 加入选中表(字段) */
            //     if (vals.length) {
            //         var htm = $('#clone .clone-box').clone();
            //         var tit = obj.find('mark').text();
            //         htm.find('h4').html('<i class="uk-icon-caret-right"></i> ' + tit);
            //         htm.find('h4').attr('data-name', tableName);
            //         for (var i = 0; i < vals.length; i++) {
            //             var tr = vals.eq(i).parents('tr');
            //             var en = tr.find('td').eq(1).text();
            //             var zh = tr.find('td').eq(8).text();
            //             htm.find('div.uk-accordion-content').append('<p>' + (i + 1) + '. ' + en + '-' + zh + '</p>');
            //         };
            //         $('#join-table-list').prepend(htm);
            //         /* 绑定事件 */
            //         htm.find('h4').click(function () {
            //             var _this = $(this);
            //             _this.next('div').slideToggle();
            //         });
            //     }
            // }
        });




        function copy(elementId) {
            var aux = document.createElement("input");
            aux.setAttribute("value", document.getElementById(elementId).innerHTML);
            document.body.appendChild(aux);
            aux.select();
            document.execCommand("copy");
            document.body.removeChild(aux);
            $('.modal1').show();
                            $('.modal1>h2').text('已复制到剪贴板');
                            setTimeout(function () {
                                $('.modal1').hide();
                            }, 1000);
        }

        $(function () {
            $('.m-main>button').click(function () {
                    "use strict";
                    let v = $('.m-main>p').text();
                    console.log(v);
                })
                //获取表的默认显示值
            var handle_id = "";
            $('.modify').click(function () {
                "use strict";
                let this_ = $(this),
                    id = this_.siblings('mark').attr('id');
                handle_id = id;
                $.post("<?php echo U('pulltable');?>", {
                    id: id
                }, function (data) {
                    if (data.status == 1) {
                        let vals = data.result;
                        $('#tname_en').val(vals.name_en);
                        $('#tname_zh').val(vals.name_zh);
                        $('#tapply_id').val(vals.apply_id);
                    } else {
                        $('.modal1').show();
                            $('.modal1>h2').text('success');
                            setTimeout(function () {
                                $('.modal1').hide();
                            }, 1000);
                    }
                });
            });
            var handle1_id = "";
            $('.modify1').click(function () {
                "use strict";
                let this_ = $(this),
                    id = this_.parent('td').siblings().find('input').attr('id');
                handle1_id = id;
                $.post("<?php echo U('pullfield');?>", {
                    id: id
                }, function (data) {
                    if (data.status == 1) {
                        let vals = data.result;
                        $('#fname_en').val(vals.field_en);
                        $('#fleng').val(vals.leng);
                        $('#fnull').val(vals.null);
                        $('#fdefault').val(vals.default);
                        $('#table_id').val(vals.table_id);
                        $('#fdata_id').val(vals.data_id);
                        $('#fexplain').val(vals.explain);
                        $('#fincre').val(vals.addself);
                        $('#fprimarykey').val(vals.majorkey);
                    } else {
                        $('.modal1').show();
                            $('.modal1>h2').text('success');
                            setTimeout(function () {
                                $('.modal1').hide();
                            }, 1000);
                    }
                });
            });
            //删除字段操作
            $('.del_col').click(function () {
                "use strict";
                let this_ = $(this),
                    tid = this_.parent('td').siblings().find('input').attr('id');
                $('.del_col3').click(function () {
                    const del_col = "<?php echo U('delete2');?>";
                    $.post(del_col, {
                        id: tid
                    }, function (data) {
                        if (data.status == 0) {
                            $('.modal1').show();
                            $('.modal1>h2').text('fail');
                            setTimeout(function () {
                                $('.modal1').hide();
                                location.reload();
                            }, 1000);
                        } else {
                            $('.modal1').show();
                            $('.modal1>h2').text('success');
                            setTimeout(function () {
                                $('.modal1').hide();
                                location.reload();
                            }, 1000);
                        }
                    });
                });
            });

            //删除表操作
            $('.del_col1').click(function () {
                "use strict";
                let this_ = $(this);
                $('.del_col2').click(function () {
                    const del_tab = "<?php echo U('delete1');?>";
                    $.post(del_tab, {
                        id: this_.siblings('mark').attr('id')
                    }, function (data) {
                        if (data.status == 0) {
                            $('.modal1').show();
                            $('.modal1>h2').text('fail');
                            setTimeout(function () {
                                $('.modal1').hide();
                            }, 1000);
                        } else {
                            $('.modal1').show();
                            $('.modal1>h2').text('success');
                            setTimeout(function () {
                                $('.modal1').hide();
                            }, 1000);
                        }
                    });
                });
            });
            //插入表名英文检测
            $('#tname_en').blur(function () {
                "use strict";
                let this_ = $(this);
                const checkfield = "<?php echo U('checktable');?>";
                $.post(checkfield, {
                    'name': $('#tname_en').val()
                }, function (data) {
                    if (data.status == 0) {
                        this_.siblings('i.s').show().siblings('i.f').hide();
                    } else {
                        this_.siblings('i.s').hide().siblings('i.f').show();
                    }
                });
            });
            //插入字段英文检测
            $('#fname_en').blur(function () {
                    "use strict";
                    let this_ = $(this);
                    const checkfield = "<?php echo U('checkfield');?>";
                    $.post(checkfield, {
                        'field_en': $('#fname_en').val(),
                        'table_id': $('#tapply_id').val()
                    }, function (data) {
                        if (data.status == 0) {
                            this_.siblings('i.s').show().siblings('i.f').hide();
                        } else {
                            this_.siblings('i.s').hide().siblings('i.f').show();
                        }
                    })
                })
                //插入表名中文检测
            $('#tname_zh').blur(function () {
                "use strict";
                let this_ = $(this);
                const checkfield = "<?php echo U('checktable');?>";
                $.post(checkfield, {
                    'name': $('#tname_zh').val()
                }, function (data) {
                    if (data.status == 0) {
                        this_.siblings('i.s').show().siblings('i.f').hide();
                    } else {
                        this_.siblings('i.s').hide().siblings('i.f').show();
                    }
                })
            })

            //添加table表记录
            $("#add_tab").click(function () {
                "use strict";
                const add_tab = "<?php echo U('addtable');?>";
                $.post(add_tab, {
                    'id': handle_id,
                    'name_en': $('#tname_en').val(),
                    'name_zh': $('#tname_zh').val(),
                    'apply_id': $('#tapply_id').val(),
                }, function (data) {
                    let vals = data.result;
                    if (data.status == 0) {
                        $('.modal1').show();
                        $('.modal1>h2').text('fail');
                        setTimeout(function () {
                            $('.modal1').hide();
                        }, 1000);
                        window.location.reload(true);
                    } else if (data.status == 1) {
                        $('.modal1').show();
                        $('.modal1>h2').text('success');
                        setTimeout(function () {
                            $('.modal1').hide();
                        }, 1000);
                    } else if (data.status == 2) {
                        $('.modal1').show();
                        $('.modal1>h2').text('exist');
                        setTimeout(function () {
                            $('.modal1').hide();
                        }, 1000);
                    }
                });
            });
            //表的默认值设为空
            $('.sky').click(function () {
                handle_id = "";
                $('#tname_en').val("");
                $('#tname_zh').val("");
                //$('#tapply_id').val("");
            });

            var tab = "";
            //字段的默认值设为空
            $('.sky1').click(function () {
                "use strict";
                let this_ = $(this),
                    tab = this_.siblings('mark').attr('id');

                handle1_id = "";
                $('#table_id').val(tab);
                $('#fname_en').val("");
                $('#fleng').val("");
                $('#fdefault').val("");
                $('#fexplain').val("");

            });
            //添加field字段
            $('#add_field').click(function () {
                "use strict";
                const add_field = "<?php echo U('addfield');?>";
                $.post(add_field, {
                    'id': handle1_id,
                    'table_id': $('#table_id').val(),
                    'leng': $('#fleng').val(),
                    'field_en': $('#fname_en').val(),
                    'default': $('#fdefault').val(),
                    'data_id': $('#fdata_id').val(),
                    'explain': $('#fexplain').val(),
                    'null': $('#fnull').val(),
                    'majorkey': $('#fprimarykey').val(),
                    'addself': $('#fincre').val(),
                }, function (data) {

                    if (data.status == 0) {
                        $('.modal1').show();
                            $('.modal1>h2').text('fail');
                            setTimeout(function () {
                                $('.modal1').hide();
                            }, 1000);
                    } else if (data.status == 1) {
                        $('.modal1').show();
                            $('.modal1>h2').text('success');
                            setTimeout(function () {
                                $('.modal1').hide();
                            }, 1000);
                    } else if (data.status == 2) {
                        $('.modal1').show();
                            $('.modal1>h2').text('exist');
                            setTimeout(function () {
                                $('.modal1').hide();
                            }, 1000);
                    }
                });
            });

            //搜索提交操作
            $('.search').click(function (e) {
                $('.frm').submit();
            });

            //生成sql语句操作
            $('#save_sql').click(function () {
                "use strict";
                let arr = [],
                    tid = $('td>input[type="checkbox"]:checked');
                const save_sql = "<?php echo U('getsql');?>";
                tid.each(function () {
                    arr.push(parseInt($(this).attr('id')));
                });
                $.post(save_sql, {
                    id: arr,
                }, function (result) {
                    $('.modal').show();
                    $('.modal>.m-main>p').text(result)
                });
                $('.back').click(function () {
                    $('.modal').hide();
                });
            });

            $(".uk-accordion-title").click(function () {
                var status = $(this).attr("status") * 1;
                if (status === 0) {
                    $(this).find("i").removeClass("uk-icon-caret-right").addClass("uk-icon-caret-down");
                    $(this).attr("status", 1);
                }
                if (status === 1) {
                    $(this).find("i").removeClass("uk-icon-caret-down").addClass("uk-icon-caret-right");
                    $(this).attr("status", 0);
                }
            });
        });

        function checkbox(_this) {
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