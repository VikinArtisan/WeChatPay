<?php

namespace Vikin\WeChatPay;
//ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);

//require_once "../lib/WxPay.Api.php";
//require_once "WxPay.NativePay.php";
//require_once 'log.php';

use Illuminate\Support\Facades\App;


class Native {
	/**
	 * 流程：
	 * 1、调用统一下单，取得code_url，生成二维码
	 * 2、用户扫描二维码，进行支付
	 * 3、支付完成之后，微信服务器会通知支付成功
	 * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
	 */
	public function mode_one ()
	{
		$WxPayUnifiedOrder = App::make('Vikin\WeChatPay\Resource\Lib\WxPayUnifiedOrder');

		$WxPayUnifiedOrder->SetBody("内容");    //内容
		$WxPayUnifiedOrder->SetAttach("附加");  //附加
		$WxPayUnifiedOrder->SetOut_trade_no(config('WeChatConfig.MCHID').date("YmdHis"));
		$WxPayUnifiedOrder->SetTotal_fee("1");  //总金额,金额需要是实际金额的100倍
		$WxPayUnifiedOrder->SetTime_start(date("YmdHis"));  //开始时间
		$WxPayUnifiedOrder->SetTime_expire(date("YmdHis", time() + 600));   //到期时间
		$WxPayUnifiedOrder->SetGoods_tag("标签");   //商品标签
		$WxPayUnifiedOrder->SetNotify_url("http://www.kmsc.cc/weixin/notify");    //通知地址
		$WxPayUnifiedOrder->SetTrade_type("NATIVE");    //支付类型(扫码支付)
		$WxPayUnifiedOrder->SetProduct_id("123456789"); //商品id

		$NativePay = App::make('Vikin\WeChatPay\Resource\NativePay');
		$result = App::call([$NativePay, 'GetPayUrl'], ['input'=>$WxPayUnifiedOrder]);
		$url = $result["code_url"];

//        return view('WeChatPay.index')->with([
//            'QrCodeUrl' => 'http://paysdk.weixin.qq.com/example/qrcode.php?data=' . urlencode($url),
//
//        ]);
		echo '<div style="margin-left: 10px;color:#556B2F;font-size:30px;font-weight: bolder;">扫描支付模式一</div><br/>';
		echo '<img alt="模式一扫码支付" src="http://paysdk.weixin.qq.com/example/qrcode.php?data='.urlencode($url).'" style="width:150px;height:150px;"/>';
	}
}