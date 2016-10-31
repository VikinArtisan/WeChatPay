<?php

namespace Vikin\WeChatPay;

use Illuminate\Support\Facades\App;
use Vikin\WeChatPay\Resource\Lib\WxPayException;

class Native {
	public function mode_one ($input)
	{
//		$WxPayUnifiedOrder = App::make('Vikin\WeChatPay\Resource\Lib\WxPayUnifiedOrder');
//
//		$WxPayUnifiedOrder->SetBody("内容");    //内容
//		$WxPayUnifiedOrder->SetAttach("附加");  //附加
//		$WxPayUnifiedOrder->SetOut_trade_no(config('WeChatConfig.MCHID').date("YmdHis"));
//		$WxPayUnifiedOrder->SetTotal_fee("1");  //总金额,金额需要是实际金额的100倍
//		$WxPayUnifiedOrder->SetTime_start(date("YmdHis"));  //开始时间
//		$WxPayUnifiedOrder->SetTime_expire(date("YmdHis", time() + 600));   //到期时间
//		$WxPayUnifiedOrder->SetGoods_tag("标签");   //商品标签
//		$WxPayUnifiedOrder->SetNotify_url("http://www.kmsc.cc/weixin/notify/");    //通知地址
//		$WxPayUnifiedOrder->SetTrade_type("NATIVE");    //支付类型(扫码支付)
//		$WxPayUnifiedOrder->SetProduct_id("123456789"); //商品id

        $NativePay = App::make('Vikin\WeChatPay\Resource\NativePay');
        $result = App::call([$NativePay, 'GetPayUrl'], ['input' => $input]);

        if (isset($result["code_url"])) {
            $url = $result["code_url"];

            return 'http://paysdk.weixin.qq.com/example/qrcode.php?data=' . urlencode($url);
        }
        throw new WxPayException($result['return_msg']);
	}
}