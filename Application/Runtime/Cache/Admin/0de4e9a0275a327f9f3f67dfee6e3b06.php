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
 

<script type="text/javascript">
    window.UEDITOR_Admin_URL = "/Public/plugins/Ueditor/";
    var URL_upload = "<?php echo ($URL_upload); ?>";
    var URL_fileUp = "<?php echo ($URL_fileUp); ?>";
    var URL_scrawlUp = "<?php echo ($URL_scrawlUp); ?>";
    var URL_getRemoteImage = "<?php echo ($URL_getRemoteImage); ?>";
    var URL_imageManager = "<?php echo ($URL_imageManager); ?>";
    var URL_imageUp = "<?php echo ($URL_imageUp); ?>";
    var URL_getMovie = "<?php echo ($URL_getMovie); ?>";
    var URL_home = "<?php echo ($URL_home); ?>";
    
    function call_back(fileurl_tmp)
    {
    	//alert(fileurl_tmp);
    }
</script>

<script type="text/javascript" src="/Public/plugins/Ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/Public/plugins/Ueditor/ueditor.all.js"></script>

<div class="wrapper">
    <div class="breadcrumbs" id="breadcrumbs">
	<ol class="breadcrumb">
	<?php if(is_array($navigate_admin)): foreach($navigate_admin as $k=>$v): if($k == '后台首页'): ?><li><a href="<?php echo ($v); ?>"><i class="fa fa-home"></i>&nbsp;&nbsp;<?php echo ($k); ?></a></li>
	    <?php else: ?>    
	        <li><a href="<?php echo ($v); ?>"><?php echo ($k); ?></a></li><?php endif; endforeach; endif; ?>          
	</ol>
</div>

    <section class="content ">
        <!-- Main content -->
        <div class="container-fluid">
            <div class="pull-right">
                <a href="javascript:history.go(-1)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="返回"><i class="fa fa-reply"></i></a>
            	<a href="javascript:;" class="btn btn-default" data-url="http://www.tp-shop.cn/Doc/Index/article/id/1011/developer/user.html" onclick="get_help(this)"><i class="fa fa-question-circle"></i> 帮助</a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i> 添加专题</h3>
                </div>
                <div class="panel-body ">   
                    <!--表单数据-->
                    <form method="post" id="handleposition" action="<?php echo U('Admin/Topic/topicHandle');?>">                    
                        <!--通用信息-->
                    <div class="tab-content col-md-10">                 	  
                        <div class="tab-pane active" id="tab_tongyong">                           
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td class="col-sm-2">专题标题：</td>
                                    <td class="col-sm-4">
                                        <input type="text" class="form-control" name="topic_title" value="<?php echo ($info["topic_title"]); ?>" >
                                        <span id="err_attr_name" style="color:#F00; display:none;"></span>                                        
                                    </td>
                                    <td class="col-sm-4">标题不能超过24个字
                                    </td>
                                </tr>
                                <tr>
                                    <td>专题封面：</td>
                                    <td>
                             			<input type="text" id="imagetext" name="topic_image" value="<?php echo ($info["topic_image"]); ?>"><input type="button" class="button" onClick="GetUploadify(1,'imagetext','topic','')"  value="上传封面"/>
                                    </td>
                                    <td class="col-sm-4">请上传990像素x240像素的图片作为专题页面的封面图</td>
                                </tr>    
                                <!--
                                <tr>
                                    <td>专题背景颜色：</td>
                                    <td >
                         				<input class="txt" name="topic_background_color" type="color" value="<?php echo ($info["topic_background_color"]); ?>" style="width:250px;"/>                                  
                                    </td>
                                    <td class="col-sm-4">背景色即专题页面CSS属性中"body{ background-color}"值，作为专业页面整体背景色使用，设置请使用十六进制形式(#XXXXXX)，默认留空为白色背景。</td>
                                </tr>  
                                <tr>
                                    <td>背景图选择：</td>
                                    <td>
                             			<input type="text" id="imagetext2" name="topic_background" value="<?php echo ($info["topic_background"]); ?>"><input type="button" class="button" onClick="GetUploadify(1,'imagetext2','topic','')"  value="浏览"/>
                                    </td>
                                    <td class="col-sm-4">背景图即专题页面CSS属性中"body{ background-image}"值，选择本地图片上传作为页面整体背景。</td>
                                </tr>  
                                <tr>
                                    <td>背景图填充方式：</td>
                                    <td>
                               			<input type="radio" class="" name="topic_repeat" value="no-repeat" <?php if($info["topic_repeat"] == 'no-repeat'): ?>checked<?php endif; ?> />
                      					不重复
                      					<input type="radio" class="" name="topic_repeat" value="repeat" <?php if($info["topic_repeat"] == 'repeat'): ?>checked<?php endif; ?> />
                      					平铺   
                      					<input type="radio" class="" name="topic_repeat" value="repeat-x" <?php if($info["topic_repeat"] == 'repeat-x'): ?>checked<?php endif; ?> />
                      					x轴平铺
                      					<input type="radio" class="" name="topic_repeat" value="repeat-y" <?php if($info["topic_repeat"] == 'repeat-y'): ?>checked<?php endif; ?> />
                      					y轴平铺
                                    </td>
                                    <td class="col-sm-4">背景图填充方式即专题页面CSS属"body{ background-repeat}"值，选择不重复(no-repeat)|平铺(repeat)|x轴平铺(repeat-x)|y轴平铺(repeat-y)为背景图的填充方式。</td>
                                </tr>  
 								-->
                                <tr>
                                    <td>内容块距顶部：</td>
                                    <td>
                      					<input type="text" class="form-control" name="topic_margin_top" value="<?php echo ($info["topic_margin_top"]); ?>" >
                                    	
                                    </td>
                                    <td class="col-sm-4">像素</td>
                                </tr>
                                <tr>
                                    <td>专题内容：</td>
                                    <td class="col-sm-8" colspan="2">
                						<textarea class="span12 ckeditor" name="topic_content" title="" style=" width:900px; height:500px;"><?php echo (htmlspecialchars_decode($info["topic_content"])); ?></textarea>
                                    </td>
                                </tr>                                 
                                </tbody> 
                                <tfoot>
                                	<tr>
                                	<td><input type="hidden" name="act" value="<?php echo ($act); ?>">
                                		<input type="hidden" name="topic_id" value="<?php echo ($info["topic_id"]); ?>">
                                		<input type="hidden" id="topic_state" name="topic_state" value="2">
                                	</td>
                                	<td class="col-sm-4"><input class="btn btn-primary" type="buuton" onclick="adsubmit(1)" value="保存草稿"></td>
                                	<td class="text-right"><input class="btn btn-primary" type="buuton" onclick="adsubmit(2)" value="发布专题"></td></tr>
                                </tfoot>                               
                                </table>
                        </div>                           
                    </div>              
			    	</form><!--表单数据-->
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    var editor;
    $(function () {
        //具体参数配置在  editor_config.js 中
        var options = {
            zIndex: 999,
            initialFrameWidth: "95%", //初化宽度
            initialFrameHeight: 400, //初化高度
            focus: false, //初始化时，是否让编辑器获得焦点true或false
            maximumWords: 99999, removeFormatAttributes: 'class,style,lang,width,height,align,hspace,valign',//允许的最大字符数 'fullscreen',
            pasteplain: true, autoHeightEnabled: true,
            autotypeset: {
                mergeEmptyline: true,        //合并空行
                removeClass: true,           //去掉冗余的class
                removeEmptyline: false,      //去掉空行
                textAlign: "left",           //段落的排版方式，可以是 left,right,center,justify 去掉这个属性表示不执行排版
                imageBlockLine: 'center',    //图片的浮动方式，独占一行剧中,左右浮动，默认: center,left,right,none 去掉这个属性表示不执行排版
                pasteFilter: false,          //根据规则过滤没事粘贴进来的内容
                clearFontSize: false,        //去掉所有的内嵌字号，使用编辑器默认的字号
                clearFontFamily: false,      //去掉所有的内嵌字体，使用编辑器默认的字体
                removeEmptyNode: false,      // 去掉空节点
                                             //可以去掉的标签
                removeTagNames: {"font": 1},
                indent: false,               // 行首缩进
                indentValue: '0em'           //行首缩进的大小
            },
        	toolbars: [
                   ['fullscreen', 'source', '|', 'undo', 'redo',
                       '|', 'bold', 'italic', 'underline', 'fontborder',
                       'strikethrough', 'superscript', 'subscript',
                       'removeformat', 'formatmatch', 'autotypeset',
                       'blockquote', 'pasteplain', '|', 'forecolor',
                       'backcolor', 'insertorderedlist',
                       'insertunorderedlist', 'selectall', 'cleardoc', '|',
                       'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                       'customstyle', 'paragraph', 'fontfamily', 'fontsize',
                       '|', 'directionalityltr', 'directionalityrtl',
                       'indent', '|', 'justifyleft', 'justifycenter',
                       'justifyright', 'justifyjustify', '|', 'touppercase',
                       'tolowercase', '|', 'link', 'unlink', 'anchor', '|',
                       'imagenone', 'imageleft', 'imageright', 'imagecenter',
                       '|', 'insertimage', 'emotion', 'insertvideo',
                       'attachment', 'map', 'gmap', 'insertframe',
                       'insertcode', 'webapp', 'pagebreak', 'template',
                       'background', '|', 'horizontal', 'date', 'time',
                       'spechars', 'wordimage', '|',
                       'inserttable', 'deletetable',
                       'insertparagraphbeforetable', 'insertrow', 'deleterow',
                       'insertcol', 'deletecol', 'mergecells', 'mergeright',
                       'mergedown', 'splittocells', 'splittorows',
                       'splittocols', '|', 'print', 'preview', 'searchreplace']
               ]
        };
        editor = new UE.ui.Editor(options);
        editor.render("post_content");
    });
    
    function adsubmit(state){
    	$('#topic_state').val(state);
    	$('#handleposition').submit();
    }
</script>
</body>
</html>