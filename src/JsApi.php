<?php
namespace Vikin\WeChatPay;

use Illuminate\Support\Facades\App;

class JsApi {

    //打印输出数组信息
    public function printf_info($data)
    {
        $info = '';

        foreach($data as $key=>$value){
            $info .= "<font color='#00ff55;'>$key</font> : $value <br/>";
        }

        echo $info;
    }

    //①、获取用户openid
    public function getUserOpenId ()
    {
        $JsApiPay = App::make('Vikin\WeChatPay\Resource\JsApiPay');
        $openId = App::call([$JsApiPay, 'GetOpenid']);


        $this->GenerateOrders($openId);
        return $openId;
    }

    //②、统一下单
    public function GenerateOrders ($openId)
    {
        $WxPayUnifiedOrder = App::make('Vikin\WeChatPay\Resource\Lib\WxPayUnifiedOrder');
        $WxPayUnifiedOrder->SetBody("test");
        $WxPayUnifiedOrder->SetAttach("test");
        $WxPayUnifiedOrder->SetOut_trade_no(config('WeChatConfig.MCHID').date("YmdHis"));
        $WxPayUnifiedOrder->SetTotal_fee("1");
        $WxPayUnifiedOrder->SetTime_start(date("YmdHis"));
        $WxPayUnifiedOrder->SetTime_expire(date("YmdHis", time() + 600));
        $WxPayUnifiedOrder->SetGoods_tag("test");
        $WxPayUnifiedOrder->SetNotify_url("http://www.kmsc.cc/weixin/notify/");
        $WxPayUnifiedOrder->SetTrade_type("JSAPI");
        $WxPayUnifiedOrder->SetOpenid($openId);

        $WxPayApi = App::make('Vikin\WeChatPay\Resource\Lib\WxPayApi');
        $order = App::call([$WxPayApi, 'unifiedOrder'], ['inputObj'=>$WxPayUnifiedOrder]);

        echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
        var_dump($order);

        $JsApiPay = App::make('Vikin\WeChatPay\Resource\JsApiPay');
        $jsApiParameters = App::call([$JsApiPay, 'GetJsApiParameters'], ['UnifiedOrderResult'=>$order]);


        //获取共享收货地址js函数参数
        $editAddress = App::call([$JsApiPay, 'GetEditAddressParameters']);
    }

    //③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
    /**
     * 注意：
     * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
     * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
     * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
     */

}