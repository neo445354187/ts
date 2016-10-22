<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>收货地址-<?php echo ($tpshop_config['shop_info_store_title']); ?></title>
    <meta http-equiv="keywords" content="<?php echo ($tpshop_config['shop_info_store_keyword']); ?>" />
    <meta name="description" content="<?php echo ($tpshop_config['shop_info_store_desc']); ?>" />
    <link rel="stylesheet" href="/Template/pc/soubao/Static/css/edit_address.css" type="text/css">
    <script src="/Public/js/jquery-1.10.2.min.js"></script>
    <script src="/Template/pc/soubao/Static/js/slider.js"></script>
	<script src="/Public/js/layer/layer-min.js"></script><!--弹窗js 参考文档 http://layer.layui.com/-->
</head>
<style type="text/css">
.wi80-BFB{width:80%}
.wi40-BFB{width:40%}
.seauii{ padding:7px 10px; margin-right:10px}
.he110{ height:110px}
.di-bl{ display:inherit}
</style>
<body>
<div class="adderss-add">
    <div class="ner-reac ol_box_4" style="visibility: visible; position: fixed; z-index: 500; width: 100%; height:100%">
        <div class="box-ct">
            <div class="box-header">
                <!-- <a href="" class="box-close"></a> -->
                <span class="box-title">添加地址</span>
            </div>
            <form action="" method="post" onSubmit="return checkForm()">
                <table width="90%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="right"><span class="xh">*</span>收货人：&nbsp;</td>
                        <td><input class="wi80-BFB" name="consignee" type="text" value="<?php echo ($address["consignee"]); ?>" maxlength="12" /></td>
                    </tr>
                    <tr>
                        <td align="right"><span class="xh">*</span>收货地址：&nbsp;</td>
                        <td>
                            <select class="di-bl fl seauii" name="province" id="province" onChange="get_city(this)">
                                <option value="0">请选择</option>
                                <?php if(is_array($province)): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><option <?php if($address['province'] == $p['id']): ?>selected<?php endif; ?>  value="<?php echo ($p["id"]); ?>"><?php echo ($p["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>

                            <select class="di-bl fl seauii" name="city" id="city" onChange="get_area(this)">
                                <option  value="0">请选择</option>
                                <?php if(is_array($city)): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><option <?php if($address['city'] == $p['id']): ?>selected<?php endif; ?>  value="<?php echo ($p["id"]); ?>"><?php echo ($p["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>

                            <select class="di-bl fl seauii" name="district" id="district" onChange="get_twon(this)">
                                <option  value="0">请选择</option>
                                <?php if(is_array($district)): $i = 0; $__LIST__ = $district;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><option <?php if($address['district'] == $p['id']): ?>selected<?php endif; ?>  value="<?php echo ($p["id"]); ?>"><?php echo ($p["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                            
                            <select class="di-bl fl seauii" name="twon" id="twon" <?php if($address['twon'] > 0 ): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif; ?>>
                            	<?php if(is_array($twon)): $i = 0; $__LIST__ = $twon;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><option <?php if($address['twon'] == $p['id']): ?>selected<?php endif; ?>  value="<?php echo ($p["id"]); ?>"><?php echo ($p["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                            <br>
                        </td>
                    </tr>
                    <tr>
                    	<td align="right" valign="top"><span class="xh">*</span>详细地址：&nbsp;</td>
                    	<td><textarea class="he110 wi80-BFB re-no" name="address" id="address" placeholder="详细地址" maxlength="100"><?php echo ($address["address"]); ?></textarea></td>
                    </tr>
                    <tr>
                        <td align="right">邮编：&nbsp;</td>
                        <td><input class="wi80-BFB" type="text" name="zipcode" value="<?php echo ($address["zipcode"]); ?>" onpaste="this.value=this.value.replace(/[^\d]/g,'')" onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" maxlength="10"/></td>
                    </tr>
                    <tr>
                        <td align="right"><span class="xh">*</span>手机：&nbsp;</td>
                        <td><input class="wi40-BFB" type="text" name="mobile" value="<?php echo ($address["mobile"]); ?>" onpaste="this.value=this.value.replace(/[^\d-]/g,'')" onKeyUp="this.value=this.value.replace(/[^\d-]/g,'')" maxlength="15"/></td>
                    </tr>
                    <tr>
                        <td class="pa-50-0">&nbsp;</td>
                        <td align="right">
                            <button type="submit" class="box-ok ma-le--70"><span>保存收货地址</span></button>
                        </td>    
                    </tr>
                </table>

            </form>
        </div>
    </div>
</div>
<script src="/Public/js/global.js"></script>
<script src="/Public/js/pc_common.js"></script>

<script>
    function checkForm(){
        var consignee = $('input[name="consignee"]').val();
        var province = $('select[name="province"]').find('option:selected').val();
        var city = $('select[name="city"]').find('option:selected').val();
        var district = $('select[name="district"]').find('option:selected').val();
        var address = $('textarea[name="address"]').val();
        var mobile = $('input[name="mobile"]').val();
        var error = '';
        if(consignee == ''){
            error += '收货人不能为空 <br/>';
        }
        if(province==0){
            error += '请选择省份 <br/>';
        }
        if(city==0){
            error += '请选择城市 <br/>';
        }
        if(district==0){
            error += '请选择区域 <br/>';
        }
        if(address == ''){
            error += '请填写地址 <br/>';
        }
        if(!checkMobile(mobile))
            error += '手机号码格式有误 <br/>';
        if(error){
            //alert(error);
			layer.alert(error, {icon: 2});
		//	layer.msg('只想弱弱提示');
            return false;
        }
        return true;
    }
</script>
</body>
</html>