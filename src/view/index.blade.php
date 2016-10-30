<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>微信支付</title>
    <link rel="stylesheet" href="http://cdn.amazeui.org/amazeui/2.7.2/css/amazeui.min.css">
    <link rel="stylesheet" href="{{asset('WeChatPay/css/style.css')}}">
</head>
<body>
<div class="am-g" style="margin-top: 100px">
    <div class="am-u-sm-9 am-u-sm-centered" id="pad">
        <div>
            <div class="pay_wrap" id="allPayments">
                <h2 class="am-text-center order-title">您的订单已提交成功，正在等待您的付款！</h2>
                <blockquote>
                    <div class="am-sans-serif">
                        您的订单号：<span id="orderNo"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        应支付：<span id="orderPrice">￥</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        支付方式：微信支付 <br><br>
                        <scmall>如果您未及时付款，再次付款时可能会出现商品缺货的情况，因此松骋建议您下单后及时付款。</scmall>
                    </div>
                </blockquote>
            </div>
        </div>
        <div data-am-widget="titlebar" class="am-titlebar am-titlebar-default">
            <h2 class="am-titlebar-title">
                <img src="./img/WePayLogo.png"/>
            </h2>
            <nav class="am-titlebar-nav">
                <a href="javascript:;" >亿万用户的选择, 更快更安全</a>
            </nav>
        </div>
        <div class="bankbox" id="cover_bankbox">
            <div style="height:481px;text-algin:center;">
                <div style="float:left;padding-top:50px;padding-left:30px;">
                    <div>
                        <div>
                            <img class="image" style="border:1px solid #ccc;" src="{{$QrCode}}">
                        </div>
                        <div id="prompt-text">
                            <img src="{{asset('WeChatPay/img/text.png')}}" alt="微信支付" width="300" class="wx-image">
                        </div>
                    </div>
                </div>
                <div class="am-fr" style="padding-top: 50px;padding-right: 30px">
                    <img src="{{asset('WeChatPay/img/phone-bg.png')}}" alt="" class="phone-image">
                </div>
            </div>
        </div>
    </div>
    <div class="am-u-sm-7 am-u-sm-centered" id="pc">
        <div>
            <div class="pay_wrap" id="allPayments">
                <h2 class="am-text-center order-title">您的订单已提交成功，正在等待您的付款！</h2>
                <blockquote>
                    <div class="am-sans-serif">
                        您的订单号：<span id="orderNo">2016102721003993</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        应支付：<span id="orderPrice">￥339.00</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        支付方式：微信支付 <br><br>
                        <scmall>如果您未及时付款，再次付款时可能会出现商品缺货的情况，因此松骋建议您下单后及时付款。</scmall>
                    </div>
                </blockquote>
            </div>
        </div>
        <div data-am-widget="titlebar" class="am-titlebar am-titlebar-default">
            <h2 class="am-titlebar-title">
                <img src="{{asset('WeChatPay/img/WePayLogo.png')}}"/>
            </h2>
            <nav class="am-titlebar-nav">
                <a href="javascript:;" >亿万用户的选择, 更快更安全</a>
            </nav>
        </div>
        <div class="bankbox" id="cover_bankbox">
            <div style="height:481px;text-algin:center;">
                <div style="float:left;padding-top:50px;padding-left:30px;">
                    <div>
                        <div>
                            <img class="image" style="border:1px solid #ccc;" src="http://www.s.cn/paycenter-wechatqr.html?data=weixin%3A%2F%2Fwxpay%2Fbizpayurl%3Fpr%3DAULfydp">
                        </div>
                        <div id="prompt-text">
                            <img src="{{asset('WeChatPay/img/text.png')}}" alt="微信支付" width="300" class="wx-image">
                        </div>
                    </div>
                </div>
                <div class="am-fr" style="padding-top: 50px;padding-right: 30px">
                    <img src="{{asset('WeChatPay/img/phone-bg.png')}}" alt="" class="phone-image">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://cdn.amazeui.org/amazeui/2.7.2/js/amazeui.min.js"></script>
</body>
</html>