<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>购物车-<?php echo ($tpshop_config['shop_info_store_title']); ?></title>
<meta http-equiv="keywords" content="<?php echo ($tpshop_config['shop_info_store_keyword']); ?>" />
<meta name="description" content="<?php echo ($tpshop_config['shop_info_store_desc']); ?>" />
<script src="/Public/js/jquery-1.8.2.min.js"></script>
<script src="/Public/js/global.js"></script>
<script src="/Public/js/pc_common.js"></script>
<script src="/Public/js/layer/layer.js"></script>
<link href="/Template/pc/soubao/Static/css/common.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/Template/pc/soubao/Static/css/jh.css">
</head>
<body>
<div class="m-top-bar editable" moduleid="1539923" style="position:relative;min-height:25px;">
  <div class="container">
    <ul class="fl">
      <?php if($user[user_id] > 0): ?><li class="fl J_login_status"><a href="<?php echo U('Home/user/index');?>" alt="" title="" target="_self"><?php echo ($user['nickname']); ?></a>
      	<a  href="<?php echo U('Home/user/logout');?>" style="margin:0 10px;" title="退出" target="_self">退出</a></li>
      </li>
      <?php else: ?>
      	<li class="fl J_login_status"><a class="menu-item fl J_do_login J_chgurl" href="<?php echo U('Home/user/login');?>">
        <span>Hi，请登录</span> </a><a class="menu-item fl ht" href="<?php echo U('Home/user/reg');?>">免费注册</a><?php endif; ?>
      <li class="fl sep"></li>
      <li class="fl select-city dropdown">
        <span class="menu-item">
        <span>送货至：</span>
        <a title="" alt="" href="" class="J_cur_place"></a><i class="dd"></i></span>
      </li>
    </ul>
    <ul class="fr bar-right">
      <li class="fl dropdown my-feiniu"><a class="menu-item" target="_blank" href="">
        <span>我的商城</span><i class="dd"></i></a>
        <ul class="sub-panel">
          <li><a class="J_chgurl" target="_blank" href="<?php echo U('/Home/User/order_list');?>">我的订单</a></li>
          <li><a class="J_chgurl" target="_blank" href="<?php echo U('/Home/User/account');?>">我的积分</a></li>
          <li><a class="J_chgurl" target="_blank" href="<?php echo U('/Home/User/coupon');?>">我的优惠券</a></li>
          <li><a class="J_chgurl" target="_blank" href="<?php echo U('/Home/User/goods_collect');?>">我的收藏夹</a></li>
          <li><a class="J_chgurl" target="_blank" href="<?php echo U('/Home/User/comment');?>">我的评论</a></li>
        </ul>
      </li> 
      <li class="fl sep"></li>
      <li class="fl dropdown mobile-feiniu"><a class="menu-item" href=""><i class="fl ico"></i>
        <span class="fl">手机TPshop网</span>
        <i class="dd"></i></a>
        <div class="sub-panel m-lst">
          <p>扫一扫，下载TPshop客户端</p>
          <dl>
            <dt class="fl mr10"><a target="_blank" href=""><img height="80" width="80" src="/Template/pc/soubao/Static/images/qrcode_vmall_app01.png"></a></dt>
            <dd class="fl mb10"><a target="_blank" href=""><i class="andr"></i> Andiord</a></dd>
            <dd class="fl"><a target="_blank" href=""><i class="iph"></i> iPhone</a></dd>
          </dl>
        </div>
      </li>
      <li class="fl sep"></li>
      <li class="fl"><a class="menu-item" href="" target="_blank">
        <span>帮助中心</span>
        </a></li>
      <li class="fl sep"></li>
      <li class="fl about-us"><a class="txt fl" style="line-height:unset;" href="">关注我们：</a></li>
      <li class="fl dropdown weixin"><a href="" class="fl ico"></a>
        <div class="sub-panel wx-box">
          <span class="arrow-b">◆</span>
          <span class="arrow-a">◆</span>
          <p class="n"> 扫描二维码 <br>	关注TPshop网官方微信 </p>
          <img src="/Template/pc/soubao/Static/images/qrcode_vmall_app01.png"></div>
      </li>
    </ul>
  </div>
</div>
<div class="fn-cart-confirm"> 
   <!-- cart-title -->
	  <div class="wrapper1190">
	     <div class="order-header">
	    	<div class="layout after">
	        	<div class="fl">
	            	<div class="logo pa-to-36 wi345">
	                	<a href="/"><img src="/Template/pc/soubao/Static/images/newLogo.png" alt=""></a>
	                </div>
	            </div>
	        	<div class="fr">
	            	<div class="pa-to-36 progress-area">
	                	<div class="progress-area-wd" style="display:none">我的购物车</div>
	                	<div class="progress-area-tx">填写核对订单信息</div>
	                	<div class="progress-area-cg" style="display:none">成功提交订单</div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- end cart-title --> 
	     <!-- end收货信息 -->
		<form name="cart2_form" id="cart2_form" method="post">
		    <div class="layout be-table fo-fa ma-bo-45">
		    	<div class="con-info">
		        	<div class="con-y-info ma-bo-35">
		            	<h3>收货人信息<b>[<a href="javascript:void(0);" onClick="add_edit_address(0);">使用新地址</a>]</b></h3>
		                <div id="ajax_address"><!--ajax 返回收货地址--></div>
		                <h3 style="margin-top:30px">自提点</h3>
						<div id="ajax_pickup"><!--ajax 返回自提点--></div>
		            </div>
		        	<div class="con-y-info ma-bo-35 con-h">
		            	<h3>发票信息<em>(请谨慎选择发票抬头，订单出库后不能修改)</em></h3>
		                <div class="order-invoice-list">
		            		<ul>
		            		<li>
		                    	<div class="invoice-main fl"><label for="dw">发票抬头:</label></div>
		                        <div class="invoice-sub fl">
		                        	<label class="inv-label">
		                        		<input class="officdw" type="text" name="invoice_title" placeholder="XXX单位 或 XX个人" />
		                            </label>
		                        </div>
		                    </li>
		            	</ul>
		            	</div>
		                <p class="tips"><em>注意：</em>如果商品由第三方卖家销售，发票内容由其卖家决定，发票由卖家开具并寄出</p>
		            </div>
					<div class="con-y-info ma-bo-35 con-h">
		            	<h3>物流信息<em>(选择相应的物流配送，订单出库后不能修改)</em></h3>
		                <div class="order-invoice-list">
		            		<ul>
		                    <?php if(is_array($shippingList)): foreach($shippingList as $k=>$v): ?><li>
		                            <div class="invoice-main">
		                                <input id="<?php echo ($v["code"]); ?>" type="radio" name="shipping_code" value="<?php echo ($v["code"]); ?>" onClick="ajax_order_price();" <?php if($k == 0): ?>checked="checked"<?php endif; ?> />
		                                <label for="gr"><?php echo ($v["name"]); ?></label>
		                                <em>(<?php echo ($v["desc"]); ?>)</em>
		                            </div>
		                        </li><?php endforeach; endif; ?>
			            	</ul>
		            	</div>
		                <p class="tips"><em>注意：</em>如果商品由第三方卖家销售，发票内容由其卖家决定，发票由卖家开具并寄出</p>
		            </div>            
		        </div>
		        <div class="sc-area">
		        	<div class="dt-order-area">
		            	<div class="order-pro-list">
		                	<div class="order-pro-list">
		                    	<div class="yxspy">
		                        	<div class="hv">您购买的以下商品</div>
		                        	<div class="bv">
		                            	<table border="0" cellpadding="0" cellspacing="0">
		                                    <thead>
		                                        <tr>
		                                            <th class="tr-pro">商品</th>
		                                            <th class="tr-price">单价（元）</th>
		                                            <?php if(($user[discount] != 1)): ?><th class="tr-price">会员折扣价</th><?php endif; ?>
		                                            <th class="tr-quantity">数量</th>
		                                            <th class="tr-subtotal">小计（元）</th>
		                                        </tr>
		                                    </thead>
		                                </table>
		                            </div>
		                        </div>
		                        <div class="leiliste">
		                        	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		                                <tbody>
		                                <?php if(is_array($cartList)): foreach($cartList as $k=>$v): if($v[selected] == '1'): ?><tr>
		                                        <td class="tr-pro">
		                                            <ul class="pro-area-2">
		                                                <li>
		                                                  <a title="<?php echo ($v["goods_name"]); ?>" target="_blank" href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$v[goods_id]));?>" seed="item-name"><?php echo ($v["goods_name"]); ?></a>
		                                                </li> 
		                                             </ul>
		                                         </td>
		                                        <!-- 预付订金商品的价格为空 -->
		                                        <td class="tr-price te-al">¥<?php echo ($v["goods_price"]); ?></td>
		                                        <?php if(($user[discount] != 1)): ?><td class="tr-price te-al">¥<?php echo ($v["member_goods_price"]); ?></td><?php endif; ?>
		                                        <td class="tr-quantity te-al"><?php echo ($v["goods_num"]); ?></td>
		                                        <td rowspan="1" class="tr-subtotal te-al">
		                                        <p><b>￥<?php echo ($v["goods_fee"]); ?></b></p>
		                                        </td>
		                                    </tr><?php endif; endforeach; endif; ?>  
		                                </tbody>
		                            </table>
		                        </div>
		                    </div>
		                </div>
		                <div class="order-pro-total">
		                	<div class="fl wctmes">
		                        <div class="syyouhui pa-to-15">
		                        	<div class="duoxuk">
		                            	 <label class="fo-fa-ta" for="order-chick">使用优惠券:</label>&nbsp;&nbsp;注：优惠券每次只能使用一张，不可多张混合使用
		                       		</div>
		                            <div class="byicd">
		                            	<div class="zhiwfnka">
		                                    	<table border="0" cellpadding="0" cellspacing="0">
		                                            <tbody>
		                                                <tr>
		                                                    <td>
		                                                    <input type="radio" class="radio vam ma-ri-10" name="couponTypeSelect" checked value="1"  onClick="ajax_order_price();" />
		                                                     <select id="coupon_id" name="coupon_id" class="vam ou-no" onChange="ajax_order_price();">                                                     
		                                                         <option value="0">选择优惠券</option>
							                                      <?php if(is_array($couponList)): foreach($couponList as $k=>$v): ?><option value="<?php echo ($v['id']); ?>"><?php echo ($v['name']); ?></option><?php endforeach; endif; ?>   
		                                                     </select>
		                                                    &nbsp;&nbsp;&nbsp;
		                                                    <input type="radio" class="radio vam ma-ri-10" name="couponTypeSelect" value="2"  onClick="ajax_order_price();" />
		                                                    <input type="text" name="couponCode" class="texter vam span-150 ma-ri-10 he18 li-he-18" placeholder="请输入优惠券代码" /> 
		                                                    <input type="button" class="button-style-disabled-4 button-action-use-disabled te-al ou-no vam" value="使用" onClick="ajax_order_price();" />
		                                                    </td>
		                                                </tr>
		                                                <tr>
		                                                    <td>   
		                                                    <label class="fo-fa-ta" for="order-chick">积分支付:</label>                                                            
		                                                    <input type="text" id="pay_points" name="pay_points" class="texter vam span-150 ma-ri-10 he18 li-he-18" placeholder="请输入使用积分" onpaste="this.value=this.value.replace(/[^\d]/g,'')" onkeyup="this.value=this.value.replace(/[^\d]/g,'')"/>
		                                                    <input type="button" class="button-style-disabled-4 button-action-use-disabled te-al ou-no vam" value="使用" onClick="ajax_order_price();" />
		                                                    <?php echo tpCache('shopping.point_rate');?> 积分抵 1元 &nbsp;&nbsp;   您的可用积分 <?php echo ($user['pay_points']); ?> 分
		                                                    </td>
		                                                </tr>
		                                                <tr>
		                                                    <td>   
		                                                    <label class="fo-fa-ta" for="order-chick">余额支付:</label>
		                                                    <input type="text" id="user_money" name="user_money" class="texter vam span-150 ma-ri-10 he18 li-he-18" placeholder="请输入使用余额"  onpaste="this.value=this.value.replace(/[^\d]/g,'')" onkeyup="this.value=this.value.replace(/[^\d]/g,'')"/>
		                                                    <input type="button" class="button-style-disabled-4 button-action-use-disabled te-al ou-no vam" value="使用" onClick="ajax_order_price();" />
		                                                    		您的可用余额 ¥ <?php echo ($user['user_money']); ?>
		                                                    </td>
		                                                </tr>                                                
		                                            </tbody>
		                                        </table>
		                                </div>
		                            </div>
		                        </div>                        
		                    </div>
		                    <div class="fr wcnhy">
		                    	<div class="fzoubddv">
		                        	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		                                <tbody>
		                                    <tr>
		                                        <td class="tal">商品总金额：</td>
		                                        <td class="tar">&nbsp;¥&nbsp;
		                                           <em id="order-cost-area"><?php echo ($total_price["total_fee"]); ?></em>
		                                        </td>
		                                    </tr>
		                                    <tr>
		                                        <td class="tal">运费：</td>
		                                        <td class="tar">&nbsp;¥&nbsp;
		                                               <em id="postFee">0.00</em> 
		                                        </td>
		                                    </tr>
		                                    <tr>
		                                        <td class="tal">使用优惠券：</td>
		                                        <td class="tar">-&nbsp;¥&nbsp;
		                                          <em><span id="couponFee">0.00</span> </em>
		                                        </td>
		                                    </tr>
		                                    <tr>
		                                        <td class="tal">使用积分：</td>
		                                        <td class="tar">-&nbsp;¥&nbsp;
		                                          <em><span id="pointsFee">0.00</span> </em>
		                                        </td>
		                                    </tr>
                                            <tr>
                                                <td class="tal">优惠活动：</td>
                                                <td class="tar">-&nbsp;¥&nbsp;
                                                  <em><span id="order_prom_amount">0.00</span> </em>
                                                </td>
                                            </tr>                                              
		                                    <tr>
		                                        <td class="tal">使用余额:</td>
		                                        <td class="tar">-&nbsp;¥&nbsp;
		                                          <em><span id="balance">0.00</span> </em>
		                                        </td>
		                                    </tr>                                    
		                                </tbody>
		                            </table>
		                            <p class="yifje-order">
		                            	<span class="p-subtotal-price"> 应付金额：
		                                    <b class="total">¥</b>
		                                    <b class="total" id="payables">0.00</b>
		                                </span>
		                            </p>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <div class="order-action-area te-al-ri">
		            	<div class="woypdbe sc-acti-list pa-to-20">
		                	<!--<span class="p-subtotal-price">应付总额：<b>¥<span class="vab" id="payableTotal">2276.00</span></b></span>-->
		                    <a class="Sub-orders gwc-qjs" href="javascript:void(0);" onClick="submit_order();"><span>提交订单</span></a>
		                </div>
		            </div>
		        </div>
		    </div>
		</form>    
    </div>
</div>

<!-- 提示切换省份 -->
<div id="changeProvince" style="display: none;">
          <div class="mask mask-cs-05 mask-4">
    <div class="mk-title">
              <h3>温馨提示</h3>
              <i data-x="1" class="mask-close-x changeAddrX"></i> </div>
    <div class="mk-adc">
              <div class="cs-01"> 您目前所在的省份为<strong>上海</strong>，选择<strong>安徽省</strong>的收货地址后，您购买的商品及价格将发生变化。 </div>
              <div class="cs-03">
        <button class="btn btn-red confirmChangeCity">切换省份</button>
        <button class="btn mask-close-x changeAddrX" data-x="1">取消</button>
      </div>
    </div>
  </div>
</div>
<!-- end 提示切换省份 --> 
<!-- 提示配送商品 -->
<div id="sorryTipLayer" style="display:none;">
    <div class="tipLayerCont">
    <p class="tip">对不起，以下商品暂时无法送达至<b>江苏省</b><b>无锡市</b><b>锡山区</b></p>
    <div class="tipLayerList">
              <div class="listHead"> <span class="name">商品名称</span> <span class="spec">规格</span> <span class="num">数量</span> <span class="price">金额</span> </div>
              <div class="listCont"> </div>
     </div>
  </div>
</div>
<!-- end 提示配送商品 --> 
<!-- footer start [[-->
<div class="foot">
          <div class="foot-box container fn-clear fixed">
    <dl class="foot-item foot-phone">
              <dt><?php echo ($tpshop_config['shop_info_phone']); ?></dt>
              <!--<dd>CEO邮箱：ceo@tp-shop.cn</dd>-->
              <dd>客服邮箱：CS@tp-shop.cn</dd>
            </dl>
	    <?php
 $md5_key = md5("select * from `__PREFIX__article_cat` where cat_id in(1,2,3,4,7)"); $sql_result_v = S("sql_".$md5_key); if(empty($sql_result_v)) { $Model = new \Think\Model(); $result_name = $sql_result_v = $Model->query("select * from `__PREFIX__article_cat` where cat_id in(1,2,3,4,7)"); S("sql_".$md5_key,$sql_result_v,TPSHOP_CACHE_TIME); } foreach($sql_result_v as $k=>$v): ?><dl class="foot-item foot-list">
              <dt class=""><?php echo ($v[cat_name]); ?></dt>
              <?php
 $md5_key = md5("select * from `__PREFIX__article` where cat_id = $v[cat_id]"); $sql_result_v2 = S("sql_".$md5_key); if(empty($sql_result_v2)) { $Model = new \Think\Model(); $result_name = $sql_result_v2 = $Model->query("select * from `__PREFIX__article` where cat_id = $v[cat_id]"); S("sql_".$md5_key,$sql_result_v2,TPSHOP_CACHE_TIME); } foreach($sql_result_v2 as $k2=>$v2): ?><dd><a target="_blank" href="<?php echo U('Home/Article/detail',array('article_id'=>$v2[article_id]));?>"><?php echo ($v2[title]); ?></a></dd><?php endforeach; ?>
	        </dl><?php endforeach; ?>  
    <dl class="foot-item foot-attention">
              <dd>
        <div class="att-weixin"> <img src="/Template/pc/soubao/Static/images/weixin.png" width="85" height="85"> </div>
        <p>TPshop网微信</p>
      </dd>
              <dd>
        <div class="att-client"> <img src="/Template/pc/soubao/Static/images/app.png" width="85" height="85"> </div>
        <p>TPshop网客户端</p>
      </dd>
            </dl>
  </div>
  <div class="foot-info container">
    <p>Copyright <em>©</em> 2016-2025 <?php echo ($tpshop_config['shop_info_store_name']); ?>  版权所有 保留一切权利 备案号:<?php echo ($tpshop_config['shop_info_record_no']); ?></p> 
    <ul class="foot-chop">
              <!--			<li class="icbc">
							<a href="" target="_blank"></a>
						</li>
						<li class="alipay">
							<a href="" target="_blank"></a>
						</li>
						<li class="unionpay">
							<a href="" target="_blank"></a>
						</li>
						<li class="tenpay">
							<a href="" target="_blank"></a>
						</li>-->
              <li class="gongshang"> <a href="" target="_blank"></a> </li>
              <li class="sh-letter"> <a href="" target="_blank"></a> </li>
              <li class="honesty"> <a href="" target="_blank"></a> </li>
              <li> <a href="" target="_blank"> <img src="/Template/pc/soubao/Static/images/time_cnnic.jpg"> </a> </li>
              <li> <a href="" target="_blank"> <img src="/Template/pc/soubao/Static/images/aqlm.jpg"> </a> </li>
            </ul>
  </div>
</div>
<script type="text/javascript" src="/Template/pc/soubao/Static/js/jquery.lazyload.js"></script>
<script src="/Public/js/global.js"></script>
<script type="text/javascript" src="/Template/pc/soubao/Static/js/common.js"></script>
<!-- footer end ]]-->
<script>
$(document).ready(function(){
	ajax_address(); // 获取用户收货地址列表
});
 
/**
* 新增修改收货地址
* id 为零 则为新增, 否则是修改
*  使用 公共的 layer 弹窗插件  参考官方手册 http://layer.layui.com/
*/
function add_edit_address(id)
{
	if(id > 0) 
		var url = "/index.php?m=Home&c=User&a=edit_address&scene=1&call_back=call_back_fun&id="+id; // 修改地址  '<?php echo U('Home/User/add_address',array('scene'=>'1','call_back'=>'call_back_fun','id'=>id));?>' //iframe的url /index.php/Home/User/add_address
	else
		var url = "/index.php?m=Home&c=User&a=add_address&scene=1&call_back=call_back_fun";	// 新增地址
	layer.open({
		type: 2,
		title: '添加收货地址',
		shadeClose: true,
		shade: 0.8,
		area: ['880px', '580px'],
		content: url,
	}); 	
} 
// 添加修改收货地址回调函数 
function call_back_fun(v){	 
	layer.closeAll(); // 关闭窗口
	ajax_address(); // 刷新收货地址
}

// 删除收货地址
function del_address(id)
{
    if(!confirm("确定要删除吗?"))
	  return false;
	  $.ajax({
		     url:"/index.php?m=Home&c=User&a=del_address&id="+id,
  			 success: function(data){
				ajax_address(); // 刷新收货地址
				$('#ajax_pickup .order-address-list').removeClass('address_current'); 	
			 }			 
	  });	
	  
}
 
/*
* ajax 获取当前用户的收货地址列表
*/
function ajax_address(){
	$.ajax({
		url:"<?php echo U('Home/Cart/ajaxAddress');?>",//+tab,
		success: function(data){
			$("#ajax_address").html('');
			$("#ajax_address").append(data);
			if(data != '') // 有收货地址列表 再计算价钱
				ajax_order_price(); // 计算订单价钱
		}
	});
}
// 切换收货地址
function swidth_address(obj)
{

	var province_id = $(obj).attr('data-province-id');
	var city_id = $(obj).attr('data-city-id');
	var district_id = $(obj).attr('data-district-id');
	if (typeof($(obj).attr('data-province-id')) != 'undefined') {
		ajax_pickup(province_id,city_id,district_id,0);
	}
	$(".order-address-list").removeClass('address_current');
	$(obj).parent().parent().parent().parent().parent().addClass('address_current');
	
	if($('#address_id').length > 0) 
		ajax_order_price(); // 计算订单价格
	 
}




//$('input:radio[name=address_id]:checked').parents('.order-address-list').addClass('address_current');

/**
 * 获取用户自提点和推荐自提点
 * @param type 1：用户自提点 ，0：用户自提点和推荐自提点
 * @param province_id 省
 * @param city_id 市
 * @param district_id 区
 */
function ajax_pickup(province_id, city_id, district_id,show) {
	$.ajax({
		type: 'GET',
		url: "<?php echo U('Home/Cart/ajaxPickup');?>",//+tab,
		data: {province_id: province_id, city_id: city_id, district_id: district_id,show:show},
		success: function (data) {
			$("#ajax_pickup").html('');
			$("#ajax_pickup").append(data);			 
		 	ajax_order_price();
		}
	});
}
//更换自提点
function replace_pickup(province_id, city_id, district_id) {
	var url = "/index.php?m=Home&c=Cart&a=replace_pickup&call_back=call_back_pickup&province_id="+province_id+"&city_id="+city_id+"&district_id="+district_id;
	layer.open({
		type: 2,
		title: '添加收货地址',
		shadeClose: true,
		shade: 0.8,
		area: ['880px', '580px'],
		content: url,
	});
}
// 添加自提点地址回调函数
function call_back_pickup(province_id,city_id,district_id){
	layer.closeAll(); // 关闭窗口	
	ajax_pickup(province_id, city_id, district_id,1);
}

// 获取订单价格
function ajax_order_price()
{

	$.ajax({
		type : "POST",
		url:"<?php echo U('Home/Cart/cart3');?>",//+tab,
		data : $('#cart2_form').serialize()+"&act=order_price",// 你的formid
        dataType: "json",
		success: function(data){
			
			if(data.status != 1)
			{ 
				layer.alert(data.msg, {icon: 2});
				// 登录超时
				if(data.status == -100) 
					location.href ="<?php echo U('Home/User/login');?>";
								
				return false;
			}
			// console.log(data);			
			$("#postFee").text(data.result.postFee); // 物流费
			$("#couponFee").text(data.result.couponFee);// 优惠券			
			$("#balance").text(data.result.balance);// 余额	
			$("#pointsFee").text(data.result.pointsFee);// 积分支付			
			$("#payables").text(data.result.payables);// 应付		
			$("#order_prom_amount").text(data.result.order_prom_amount);// 订单 优惠活动 																
		}
	});	
}

// 提交订单
ajax_return_status = 1; // 标识ajax 请求是否已经回来 可以进行下一次请求
function submit_order()
{
	if(ajax_return_status == 0)
	    return false;
		
	ajax_return_status = 0;
	
	$.ajax({
		type : "POST",
		url:"<?php echo U('Home/Cart/cart3');?>",//+tab,
		data : $('#cart2_form').serialize()+"&act=submit_order",// 你的formid
        dataType: "json",
		success: function(data){
										
			if(data.status != '1')
			{
				// alert(data.msg); //执行有误
				layer.alert(data.msg, {icon: 2});				
				
				// 登录超时
				if(data.status == -100) 
					location.href ="<?php echo U('Home/User/login');?>";
				
				ajax_return_status = 1; // 上一次ajax 已经返回, 可以进行下一次 ajax请求		
				
				return false;
			}
			// console.log(data);			
			$("#postFee").text(data.result.postFee); // 物流费
			$("#couponFee").text(data.result.couponFee);// 优惠券			
			$("#balance").text(data.result.balance);// 余额	
			$("#pointsFee").text(data.result.pointsFee);// 积分支付			
			$("#payables").text(data.result.payables);// 应付	
			$("#order_prom_amount").text(data.result.order_prom_amount);// 订单 优惠活动 						
			//layer.alert('订单提交成功，跳转支付页面!', {icon: 1}); //alert('订单提交成功，跳转支付页面!');						
			layer.msg('订单提交成功，跳转支付页面!', {
			  icon: 1,   // 成功图标
			  time: 2000 //2秒关闭（如果不配置，默认是3秒）
			}, function(){ // 关闭后执行的函数
					location.href = "/index.php?m=Home&c=Cart&a=cart4&order_id="+data.result; // 跳转到结算页
			});			
										
		}
	});	
}
</script>
</body>
</html>