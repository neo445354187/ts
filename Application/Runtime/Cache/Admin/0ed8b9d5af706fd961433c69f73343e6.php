<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>tpshop管理后台</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
 	<link href="/Public/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 --
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/Public/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
    	folder instead of downloading all of them to reduce the load. -->
    <link href="/Public/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="/Public/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />   
    <!-- jQuery 2.1.4 -->
    <script src="/Public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="/Public/js/global.js"></script>
    <script src="/Public/js/myFormValidate.js"></script>    
    <script src="/Public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/Public/js/layer/layer-min.js"></script><!-- 弹窗js 参考文档 http://layer.layui.com/-->
    <script src="/Public/js/myAjax.js"></script>
    <script type="text/javascript">
    function delfunc(obj){
    	layer.confirm('确认删除？', {
    		  btn: ['确定','取消'] //按钮
    		}, function(){
   				$.ajax({
   					type : 'post',
   					url : $(obj).attr('data-url'),
   					data : {act:'del',del_id:$(obj).attr('data-id')},
   					dataType : 'json',
   					success : function(data){
   						if(data==1){
   							layer.msg('操作成功', {icon: 1});
   							$(obj).parent().parent().remove();
   						}else{
   							layer.msg(data, {icon: 2,time: 2000});
   						}
   						layer.closeAll();
   					}
   				})
    		}, function(index){
    			layer.close(index);
    			return false;// 取消
    		}
    	);
    }
    
    //全选
    function selectAll(name,obj){
    	$('input[name*='+name+']').prop('checked', $(obj).checked);
    }   
    
    function get_help(obj){
        layer.open({
            type: 2,
            title: '帮助手册',
            shadeClose: true,
            shade: 0.3,
            area: ['90%', '90%'],
            content: $(obj).attr('data-url'), 
        });
    }
    
    function delAll(obj,name){
    	var a = [];
    	$('input[name*='+name+']').each(function(i,o){
    		if($(o).is(':checked')){
    			a.push($(o).val());
    		}
    	})
    	if(a.length == 0){
    		layer.alert('请选择删除项', {icon: 2});
    		return;
    	}
    	layer.confirm('确认删除？', {btn: ['确定','取消'] }, function(){
    			$.ajax({
    				type : 'get',
    				url : $(obj).attr('data-url'),
    				data : {act:'del',del_id:a},
    				dataType : 'json',
    				success : function(data){
    					if(data == 1){
    						layer.msg('操作成功', {icon: 1});
    						$('input[name*='+name+']').each(function(i,o){
    							if($(o).is(':checked')){
    								$(o).parent().parent().remove();
    							}
    						})
    					}else{
    						layer.msg(data, {icon: 2,time: 2000});
    					}
    					layer.closeAll();
    				}
    			})
    		}, function(index){
    			layer.close(index);
    			return false;// 取消
    		}
    	);	
    }
    </script>        
  </head>
  <body style="background-color:#ecf0f5;">
 

<div class="wrapper">
    <div class="breadcrumbs" id="breadcrumbs">
	<ol class="breadcrumb">
	<?php if(is_array($navigate_admin)): foreach($navigate_admin as $k=>$v): if($k == '后台首页'): ?><li><a href="<?php echo ($v); ?>"><i class="fa fa-home"></i>&nbsp;&nbsp;<?php echo ($k); ?></a></li>
	    <?php else: ?>    
	        <li><a href="<?php echo ($v); ?>"><?php echo ($k); ?></a></li><?php endif; endforeach; endif; ?>          
	</ol>
</div>

    <section class="content">
        <!-- Main content -->
        <div class="container-fluid">
            <div class="pull-right">
                <a href="javascript:history.go(-1)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="返回"><i class="fa fa-reply"></i></a>
            	<a href="javascript:;" class="btn btn-default" data-url="http://www.tp-shop.cn/Doc/Index/article/id/1009/developer/user.html" onclick="get_help(this)"><i class="fa fa-question-circle"></i> 帮助</a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i> 商品属性</h3>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_tongyong" data-toggle="tab">商品属性</a></li>
                    </ul>
                    <!--表单数据-->
                    <form method="post" id="addEditGoodsAttributeForm">                    
                        <!--通用信息-->
                    <div class="tab-content">                 	  
                        <div class="tab-pane active" id="tab_tongyong">
                           
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td>属性名称：</td>
                                    <td>
                                        <input type="text" value="<?php echo ($goodsAttribute["attr_name"]); ?>" name="attr_name"/>
                                        <span id="err_attr_name" style="color:#F00; display:none;"></span>                                        
                                    </td>
                                </tr>  
                                <tr>
                                    <td>所属商品类型：</td>
                                    <td>
                                        <select name="type_id" id="type_id">
                                             <option value="">请选择</option>
                                            <?php if(is_array($goodsTypeList)): $i = 0; $__LIST__ = $goodsTypeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo[id]); ?>" <?php if($vo[id] == $goodsAttribute[type_id]): ?>selected="selected"<?php endif; ?>><?php echo ($vo[name]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>                                        
                                        </select>
                                        <span id="err_type_id" style="color:#F00; display:none;"></span>                                        
                                    </td>
                                </tr>  
                                <tr>
                                    <td>能否进行检索：</td>
                                    <td>
                                        <input type="radio" value="0" name="attr_index" <?php if($goodsAttribute[attr_index] == 0): ?>checked="checked"<?php endif; ?>  .>不需要检索
                                        <input type="radio" value="1" name="attr_index" <?php if(($goodsAttribute[attr_index] == 1) or ($goodsAttribute[attr_index] == NULL)): ?>checked="checked"<?php endif; ?>  />关键字检索
                                        <!--<input type="radio" value="2" name="attr_index" <?php if($goodsAttribute[attr_index] == 2): ?>checked="checked"<?php endif; ?>  />范围检索-->
                                    </td>
                                </tr>  
                                <!--
                                <tr>
                                    <td>属性是否可选：</td>
                                    <td>
                                        <input type="radio" value="0" name="attr_type" <?php if(($goodsAttribute[attr_type] == 0) or ($goodsAttribute[attr_type] == NULL)): ?>checked="checked"<?php endif; ?>  />唯一属性
                                        <input type="radio" value="1" name="attr_type" <?php if($goodsAttribute[attr_type] == 1): ?>checked="checked"<?php endif; ?> />单选属性
                                        <input type="radio" value="2" name="attr_type" <?php if($goodsAttribute[attr_type] == 2): ?>checked="checked"<?php endif; ?> />复选属性 
                                    </td>
                                </tr>  
                                -->
                                <tr>
                                    <td>该属性值的录入方式：</td>
                                    <td>
                                        <input type="radio" value="0" name="attr_input_type" <?php if(($goodsAttribute[attr_input_type] == 0) or ($goodsAttribute[attr_input_type] == NULL)): ?>checked="checked"<?php endif; ?> />手工录入
                                        <input type="radio" value="1" name="attr_input_type" <?php if($goodsAttribute[attr_input_type] == 1): ?>checked="checked"<?php endif; ?>  />从下面的列表中选择（一行代表一个可选值）
                                        <input type="radio" value="2" name="attr_input_type" <?php if($goodsAttribute[attr_input_type] == 2): ?>checked="checked"<?php endif; ?>  />多行文本框                                     
                                    </td>
                                </tr>  
                                <tr>
                                    <td>可选值列表：</td> 
                                    <td>
                                    <textarea rows="5" cols="30" name="attr_values"><?php echo ($goodsAttribute["attr_values"]); ?></textarea>
                                    录入方式为手工或者多行文本时，此输入框不需填写。
                                    <span id="err_attr_values" style="color:#F00; display:none;"></span>
                                    </td>
                                </tr>                                
                                </tbody>                                
                                </table>
                        </div>                           
                    </div>              
                    <div class="pull-right">
                        <input type="hidden" name="attr_id" value="<?php echo ($goodsAttribute["attr_id"]); ?>">
                        <button class="btn btn-primary" title="" data-toggle="tooltip" type="button" onclick="ajax_submit_form('addEditGoodsAttributeForm','<?php echo U('Goods/addEditGoodsAttribute?is_ajax=1');?>');" data-original-title="保存"><i class="fa fa-save"></i></button>
                    </div>
			    </form><!--表单数据-->
                </div>
            </div>
        </div>    <!-- /.content -->
    </section>
</div>
</body>
</html>