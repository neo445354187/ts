<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">   
    <title>注册-<?php echo ($tpshop_config['shop_info_store_title']); ?></title>
    <meta http-equiv="keywords" content="<?php echo ($tpshop_config['shop_info_store_keyword']); ?>" />
    <meta name="description" content="<?php echo ($tpshop_config['shop_info_store_desc']); ?>" />
    <link href="/Template/pc/soubao/Static/css/reset.css" rel="stylesheet" />
    <link href="/Template/pc/soubao/Static/css/reg3.css" rel="stylesheet" />
    <link rel='stylesheet' type='text/css' href='/Template/pc/soubao/Static/css/common2.css'>    
    <link rel="stylesheet" type="text/css" href="/Template/pc/soubao/Static/css/common.min.css">
    <script type="text/javascript" src="/Public/js/jquery-1.10.2.min.js"></script>
	<script src="/Public/js/layer/layer.js"></script><!--弹窗js 参考文档 http://layer.layui.com/-->    
    <script src="/Public/js/global.js"></script>
</head>
<body>
    <div class="regcon">
        <a class="m-fnlogoa fn-fl" href=""><img src="<?php echo ($tpshop_config['shop_info_store_logo']); ?>"/></a><span class="m-fntit">欢迎注册</span>
        <div class="ui_tab">
            <ul class="ui_tab_nav regnav">
                <li class="uli <?php if($_GET['t'] == ''): ?>active<?php endif; ?> "><a href="<?php echo U('Home/User/reg');?>" >手机注册</a></li>
                <li class="uli <?php if($_GET['t'] == 'email'): ?>active<?php endif; ?> "><a href="<?php echo U('Home/User/reg/t/email');?>">邮箱注册</a></li>
                <li class="no fn-fr loginbtn">我已注册，马上<a href="<?php echo U('Home/User/login');?>">登录></a></li>
            </ul>
            
<?php if($_GET['t'] == ''): ?><form id="reg_form2" onsubmit=" return check_submit(this)" method="post" action="">            
            <div class="ui_tab_content">
                <div class="m-fnbox ui_panel" style="display: block;">
                    <div class="fnlogin clearfix">
                    
                        <div class="line">
                            <label class="linel"><span class="dt">手机号码：</span></label>
                            <div class="liner">
                                <input type="text" class="inp fmobile J_cellphone" placeholder="请输入手机号码"  name="username" id="username" required=""/>
                                <p class="fn-fl errorbox v-txt" id="err_username">手机号码输入不正确</p>
                            </div>
                        </div>
                        <?php if($regis_sms_enable == 1): ?><div class="line">
                            <label class="linel"><span class="dt">手机验证码：</span></label>
                            <div class="liner">
                                <input type="text" class="inp imgcode J_imgcode" placeholder="手机验证码" id="code" name="code" required=""/>                                
                                <button class="fn-fl icode" id="sendSms" onclick="send_sms_reg_code()" type="button" id="count_down">发送</button>
                                <p class="fn-fl errorbox v-txt" id="err_code">验证码输入不正确</p>
                            </div>
                            <div id="show-voice" class="show-voice"></div>
                        </div><?php endif; ?>
                        <div class="line">
                            <label class="linel"><span class="dt">设置密码：</span></label>
                            <div class="liner">
                                <input type="password" class="inp fpass J_password" placeholder="6-16位大小写英文字母、数字或符号的组合" autocomplete="off" maxlength="16"  id="password" name="password" value="" required=""/>
                                <p class="fn-fl noticebox v-txt2" id="err_password">6-16位字符，建议由字母、数字和符号两种以上组合</p>                               
                            </div>
                        </div>
                        <div class="line">
                            <label class="linel"><span class="dt">确认密码：</span></label>
                            <div class="liner">
                                <input type="password" class="inp fsecpass J_password2" placeholder="请再次输入密码" autocomplete="off" maxlength="16" id="password2" name="password2" required="" value=""/>
                                <p class="fn-fl errorbox v-txt" id="err_password2">两次输入密码不一致</p>
                            </div>
                        </div>
						<div class="line">
                            <label class="linel"><span class="dt">图像验证码：</span></label>
                            <div class="liner">
                                <input type="text" class="inp imgcode J_imgcode" placeholder="图像验证码" id="verify_code2" name="verify_code" required=""/>
								<img width="100" height="35" src="/index.php/Home/User/verify/type/user_reg.html" id="reflsh_code2" class="po-ab to0">
                                <a><img onclick="verify('reflsh_code2')" src="/Template/pc/soubao/Static/images/chg_image.png" class="ma-le-210"></a>
                                <p class="fn-fl errorbox v-txt" id="err_verify_code">请输入验证码</p>
                            </div>
                            <div id="show-voice" class="show-voice"></div>
                        </div>
                        <div class="line liney clearfix">
                            <label class="linel">&nbsp;</label>
                            <div class="liner">
                                <div class="clearfix checkcon">
                                    <p class="fn-fl checktxt"><input type="checkbox" class="iyes fn-fl J_protocal" checked />
                                    <span class="fn-fl">我已阅读并同意</span><a class="itxt fn-fl" href="" target="_blank">《TPshop网服务协议》</a>
                                    </p>
                                      <p class="fn-fl errorbox v-txt" id="protocalBox"></p>
                                </div>
                                <a class="regbtn J_btn_agree" href="javascript:void(0);" onClick="$('#reg_form2').submit();">同意协议并注册</a>
                                <p class="v-txt"><span class="fnred">请勾选</span>我已阅读并同意<a class="itxt" href="" target="_blank">《TPshop网服务协议》</a></p>
                        </div>
                    </div>
                    </div>
                    </div>
            </div>
            </form><?php endif; ?>
<?php if($_GET['t'] == 'email'): ?><form id="reg_form2" onsubmit=" return check_submit(this)" method="post" action="">            
            <div class="ui_tab_content">
                <div class="m-fnbox ui_panel" style="display: block;">
                    <div class="fnlogin clearfix">
                    
                        <div class="line">
                            <label class="linel"><span class="dt">邮箱：</span></label>
                            <div class="liner">
                                <input type="text" class="inp J_cellphone" placeholder="请输入邮箱"  name="username" id="username" required=""/>
                                <p class="fn-fl errorbox v-txt" id="err_username">邮箱输入不正确</p>
                            </div>
                        </div>                                               
                        <div class="line">
                            <label class="linel"><span class="dt">设置密码：</span></label>
                            <div class="liner">
                                <input type="password" class="inp fpass J_password" placeholder="6-16位大小写英文字母、数字或符号的组合" autocomplete="off" maxlength="16"  id="password" name="password" value="" required=""/>
                                <p class="fn-fl noticebox v-txt2" id="err_password">6-16位字符，建议由字母、数字和符号两种以上组合</p>                               
                            </div>
                        </div>
                        <div class="line">
                            <label class="linel"><span class="dt">确认密码：</span></label>
                            <div class="liner">
                                <input type="password" class="inp fsecpass J_password2" placeholder="请再次输入密码" autocomplete="off" maxlength="16" id="password2" name="password2" required="" value=""/>
                                <p class="fn-fl errorbox v-txt" id="err_password2">两次输入密码不一致</p>
                            </div>
                        </div>
						<div class="line">
                            <label class="linel"><span class="dt">图像验证码：</span></label>
                            <div class="liner">
                                <input type="text" class="inp imgcode J_imgcode" placeholder="图像验证码" id="verify_code2" name="verify_code" required=""/>
								<img width="100" height="35" src="/index.php/Home/User/verify/type/user_reg.html" id="reflsh_code2" class="po-ab to0">
                                <a><img onclick="verify('reflsh_code2')" src="/Template/pc/default/Static/images/chg_image.png" class="ma-le-210"></a>
                                <p class="fn-fl errorbox v-txt" id="err_verify_code">请输入验证码</p>
                            </div>
                            <div id="show-voice" class="show-voice"></div>
                        </div>
                        <div class="line liney clearfix">
                            <label class="linel">&nbsp;</label>
                            <div class="liner">
                                <div class="clearfix checkcon">
                                    <p class="fn-fl checktxt"><input type="checkbox" class="iyes fn-fl J_protocal" checked />
                                    <span class="fn-fl">我已阅读并同意</span><a class="itxt fn-fl" href="" target="_blank">《TPshop网服务协议》</a>
                                    </p>
                                      <p class="fn-fl errorbox v-txt" id="protocalBox"></p>
                                </div>
                                <a class="regbtn J_btn_agree" href="javascript:void(0);" onClick="$('#reg_form2').submit();">同意协议并注册</a>
                                <p class="v-txt"><span class="fnred">请勾选</span>我已阅读并同意<a class="itxt" href="" target="_blank">《TPshop网服务协议》</a></p>
                        </div>
                    </div>
                    </div>
                    </div>
            </div>
            </form><?php endif; ?>
            
        </div>
    </div>    
</div>    
 <div class="fn-cms-footer">
  <div class="m-footer-g">
    <div class="footer-map">
      <ul class="fn-clear">
        <li class="map"><i class="footer-icon z-icon"></i><strong class="tit">正品低价</strong><br/>
          <span class="desc">正品行货 品质保障</span>
        </li>
        <li class="line"></li>
        <li class="map"><i class="footer-icon q-icon"></i><strong class="tit">品类齐全</strong><br/>
          <span class="desc">品类齐全 选择丰富</span>
        </li>
        <li class="line"></li>
        <li class="map"><i class="footer-icon k-icon"></i><strong class="tit">快速配送</strong><br/>
          <span class="desc">多仓直发 极速配送</span>
        </li>
        <li class="line"></li>
        <li class="map"><i class="footer-icon t-icon"></i><strong class="tit">售后无忧</strong><br/>
          <span class="desc">7天无理由退货</span>
        </li>
      </ul>
    </div>
    <div class="server-list">
      <ul class="fn-clear">
	    <?php
 $md5_key = md5("select * from `__PREFIX__article_cat` where cat_id in(1,2,3,4,7)"); $sql_result_v = S("sql_".$md5_key); if(empty($sql_result_v)) { $Model = new \Think\Model(); $result_name = $sql_result_v = $Model->query("select * from `__PREFIX__article_cat` where cat_id in(1,2,3,4,7)"); S("sql_".$md5_key,$sql_result_v,TPSHOP_CACHE_TIME); } foreach($sql_result_v as $k=>$v): ?><li><i class="list-icon icon<?php echo ($k+1); ?>"></i>
          <dl class="list-item">
            <dt><?php echo ($v[cat_name]); ?></dt>
            <?php
 $md5_key = md5("select * from `__PREFIX__article` where cat_id = $v[cat_id]  and is_open=1"); $sql_result_v2 = S("sql_".$md5_key); if(empty($sql_result_v2)) { $Model = new \Think\Model(); $result_name = $sql_result_v2 = $Model->query("select * from `__PREFIX__article` where cat_id = $v[cat_id]  and is_open=1"); S("sql_".$md5_key,$sql_result_v2,TPSHOP_CACHE_TIME); } foreach($sql_result_v2 as $k2=>$v2): ?><dd><a href="<?php echo U('Home/Article/detail',array('article_id'=>$v2[article_id]));?>"><?php echo ($v2[title]); ?></a></dd><?php endforeach; ?>
          </dl>
        </li><?php endforeach; ?>
        <li class="app-item">
          <p>TPshop官网</p>
          <img width="90" height="90" title="" alt="TPshop网客户端" src="/Template/pc/soubao/Static/images/qrcode_vmall_app01.png">
        </li>
      </ul>
    </div>
    <div class="site-info">
      <div class="foot-nav">
	      <a href="" target="_blank">公司介绍</a>| 
	      <a href="" target="_blank">媒体报道</a>| 
	      <a href="" target="_blank">热搜索词</a>| 
	      <a href="" target="_blank">友情链接</a>| 
	      <a href="" target="_blank">商家入驻</a>| 
	      <a href="" target="_blank">招商标准</a>| 
	      <a href="" style="cursor:default;text-decoration:none;">客服热线 <?php echo ($tpshop_config['shop_info_phone']); ?></a>
	  </div>
      <div class="link">
        <p>
        Copyright © 2016-2025 <?php echo ($tpshop_config['shop_info_store_name']); ?>  版权所有 保留一切权利 备案号:<?php echo ($tpshop_config['shop_info_record_no']); ?>
        
        <!--您好,请您给TPshop留个友情链接-->
        &nbsp;&nbsp;<a href="http://www.tp-shop.cn/">TPshop开源商城</a>
        <!--您好,请您给TPshop留个友情链接-->        
        </p>        
      </div>
      <div class="inline-box logowall"><a href="" class="item shgs" target="_blank"></a><a href="" class="item shwl" target="_blank"></a><a href="" class="item cxwz" target="_blank"></a><a href="" class="item kxwz" target="_blank"></a><a href="" class="item hyyz" target="_blank"></a></div>
    </div>
  </div>
</div>
<script type="text/javascript" src="/Template/pc/soubao/Static/js/jquery.lazyload.js"></script>
<script type="text/javascript" src="/Template/pc/soubao/Static/js/common.js"></script>
<script>

    $(document).ready(function(){
		 $('input').click(function(){
		      $(this).siblings('p').hide();
		 });
        $("#username").blur(function () {
            var username = $('#username').val();
            var re = /^(13[0-9]{9})|(15[^4,\\D][0-9]{8})|(18[0-9]{9})|(17[0-9]{9})|((\w{1,20}@\w{1,20}.[a-z]{2,5}))$/;
            var id = $(this).attr("id");
            var id2 = "err_" + id;
            if (re.test(username)) {
                $.ajax({
                    type : "GET",
                    url:"/index.php?m=Home&c=Api&a=issetMobileOrEmail",//+tab,
                    data :{mobile:username},// 你的formid 搜索表单 序列化提交
                    success: function(data)
                    {
                        if(data == '0')
                        {
                            $('#err_username').css('color','green');
                            $('#err_username').html('* 可以注册');
                        }else{
                            $('#err_username').css('color','red');
                            $('#err_username').html('* 手机号/邮箱已存在');
                        }
                        $('#err_username').show();
                    }
                });
            } else {
                $("#" + id2).html("请输入正确的邮箱/手机号").show();
            }
        }).focus(function () {
            var id = $(this).attr("id");
            var id2 = "err_" + id;
            $("#" + id2).hide();
        });
	});
 
	// 普通 图形验证码 
    function verify(id){
        $('#'+id).attr('src','/index.php?m=Home&c=User&a=verify&type=user_reg&r='+Math.random());
    }
    function check_submit(){
        var username = $('input[name="username"]').val();
        var password = $('#password').val();
        var password2 = $('input[name="password2"]').val();
        var verify_code = $('input[name="verify_code"]').val();		
        var agree = $('input[type="checkbox"]:checked').val();
        var error = '';
		
		$("p[id^='err_']").each(function(){
			$(this).hide();
		});			
		
	   (username == '') && $('#err_username').show();
	   ($.trim($('#code').val()) == '') && $('#err_code').show();
	   (password == '') && $('#err_password').show();
	   (password2 != password) && $('#err_password2').show();
	   (verify_code == '') && $('#err_verify_code').show();
		if($('#username').hasClass('fmobile')){
			if(!checkMobile(username)){
				$('#err_username').show();
			}
		}else{
			if(!checkEmail(username)){
				$('#err_username').show();
			}
		}
	   if($("p[id^='err_']:visible").length > 0 ) 
		  return false;

    }
	// 电子邮件注册  和 手机号码注册 切换
    function reg_tab(id,id2){
        $('#'+id).addClass('ema-tab');
        $('#'+id2).removeClass('ema-tab');
        $('#'+id+'_div').show();
        $('#'+id2+'_div').hide();
    }
	// 发送手机短信
    function send_sms_reg_code(){
        var mobile = $('input[name="username"]').val();
        if(!checkMobile(mobile)){
            layer.alert('请输入正确的手机号码', {icon: 2});//alert('请输入正确的手机号码');
            return;
        }
        var url = "/index.php?m=Home&c=User&a=send_sms_reg_code&mobile="+mobile;
        $.ajax({
            type : "GET",
            url: url,
            dataType: "json",
            success: function(data)
            {
                if(data.status == 1)
                {
                    $('#sendSms').attr("disabled","disabled");
                    intAs = <?php echo ($sms_time_out); ?>; // 手机短信超时时间
                    jsInnerTimeout('sendSms',intAs);
                }
                layer.alert(data.msg, {icon: 1});// alert(obj.msg);
            }
        });
    }

    $('#count_down').removeAttr("disabled");
    //倒计时函数
    function jsInnerTimeout(id,intAs)
    {
        var codeObj=$("#"+id);
        //var intAs = parseInt(codeObj.attr("IntervalTime"));

        intAs--;
        if(intAs<=-1)
        {
            codeObj.removeAttr("disabled");
//            codeObj.attr("IntervalTime",60);
            codeObj.text("发送");
            return true;
        }

        codeObj.text(intAs+'秒');
//        codeObj.attr("IntervalTime",intAs);

        setTimeout("jsInnerTimeout('"+id+"',"+intAs+")",1000);
    };
    
    
    function checkMobile(tel) {
        var reg = /(^1[3|4|5|7|8][0-9]{9}$)/;
        if (reg.test(tel)) {
            return true;
        }else{
            return false;
        };
    }
    
    function checkEmail(str){
        var reg = /^([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
        if(reg.test(str)){
            return true;
        }else{
            return false;
        }
    }
</script>
</body> 
</html>