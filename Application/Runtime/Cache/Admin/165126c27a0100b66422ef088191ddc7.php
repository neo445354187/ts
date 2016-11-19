<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html dir="ltr" lang="cn">
<head>
    <meta charset="UTF-8" />
    <title>配货单打印</title>
    <link href="/Public/bootstrap/css/bootstrap.css" rel="stylesheet" media="all" />
    <script type="text/javascript" src="/Public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script type="text/javascript" src="/Public/bootstrap/css/bootstrap.min.css"></script>
    <link href="/Public/bootstrap/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
    <style media="print" type="text/css">.noprint{display:none}</style>
</head>
<body>
<div class="container">
    <div style="page-break-after: always;">
        <h1 class="text-center">订单信息</h1>
        <table class="table table-bordered">
            <thead>
            <tr>
                <td style="width: 50%;">发送自</td>
                <td style="width: 50%;">订单详情</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><address><strong><?php echo ($shop["store_name"]); ?></strong><br/><?php echo ($shop["address"]); ?></address>
                    <b>电话:</b> <?php echo ($shop["phone"]); ?><br/>
                    <b>E-Mail:</b> <?php echo ($shop["smtp_user"]); ?><br/>
                    <b>网址:</b> <a href="<?php echo ($shop["tpshop_http"]); ?>"><?php echo ($shop["tpshop_http"]); ?></a>
                </td>
                <td style="width: 50%;">
                	<b>下单日期:</b> <?php echo (date('Y-m-d',$order["add_time"])); ?><br />
                    <b>订单号:</b> <?php echo ($order["order_sn"]); ?><br />
                    <b>支付方式:</b> <?php echo ($order["pay_name"]); ?><br/>
                    <b>配送方式:</b> <?php echo ($order["shipping_name"]); ?><br/>
                </td>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
            <tr>
                <td colspan="4"><b>收货信息</b></td>
            </tr>
            <tr><td>收件人</td><td>联系电话</td><td>收货地址</td><td>邮编</td></tr>
            </thead>
            <tbody>
            <tr>
            	<td><?php echo ($order["consignee"]); ?></td>
            	<td><?php echo ($order["mobile"]); ?></td>
                <td><?php echo ($order["province"]); ?>&nbsp;&nbsp;<?php echo ($order["city"]); ?>&nbsp;&nbsp;<?php echo ($order["district"]); ?>&nbsp;&nbsp;<?php echo ($order["address"]); ?></td>
                <td><?php echo ($order["zipcode"]); ?></td>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
            <tr>
                <td><b>商品名称</b></td>
                <td><b>规格属性</b></td>
                <td><b>数量</b></td>
                <td><b>单价</b></td>
                <td class="text-right"><b>小计</b></td>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($orderGoods)): $i = 0; $__LIST__ = $orderGoods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$good): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($good["goods_name"]); ?></td>
                    <td><?php echo ($good["spec_key_name"]); ?></td>
                    <td><?php echo ($good["goods_num"]); ?></td>
                    <td><?php echo ($good["goods_price"]); ?></td>
                    <td class="text-right"><?php echo ($good["goods_total"]); ?></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
            <tfoot>
            <tr><td colspan="5" class="text-center"><input class="btn btn-default noprint" type="submit" onclick="window.print();" value="打印"></td></tr>
            </tfoot>
        </table>
    </div>
</div>
</body>
</html>