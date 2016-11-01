<?php
namespace Vikin\WeChatPay\Resource;
//require_once "../lib/WxPay.Api.php";
use Illuminate\Support\Facades\App;


/**
 * 
 * 刷卡支付实现类
 * @author widyhu
 *
 */
class NativePay
{
    /**
     * 生成扫描支付URL
     * @param $productId
     * @return string
     */
	public function GetPrePayUrl($productId)
	{
        $WxPayBizPayUrl = App::make('Vikin\WeChatPay\Resource\Lib\WxPayBizPayUrl');
        App::call([$WxPayBizPayUrl, 'SetProduct_id'], ['value'=>$productId]);

        $WxPayApi = App::make('Vikin\WeChatPay\Resource\Lib\WxPayApi');
        $values = App::call([$WxPayApi, 'bizpayurl'], ['inputObj'=>$WxPayBizPayUrl]);

		$url = "weixin://wxpay/bizpayurl?" . $this->ToUrlParams($values);

		return $url;
	}

    /**
     * 参数数组转换为url参数
     * @param $urlObj
     * @return string
     */
	private function ToUrlParams($urlObj)
	{
		$buff = "";
		foreach ($urlObj as $k => $v)
		{
			$buff .= $k . "=" . $v . "&";
		}
		
		$buff = trim($buff, "&");
		return $buff;
	}
	
	/**
	 * 
	 * 生成直接支付url，支付url有效期为2小时,模式二
	 * @param UnifiedOrderInput $input
	 */
	public function GetPayUrl($input)
	{
		if($input->GetTrade_type() == "NATIVE")
		{
		    $WxPayApi = App::make('Vikin\WeChatPay\Resource\Lib\WxPayApi');

            $result = App::call([$WxPayApi, 'unifiedOrder'], ['inputObj'=>$input]);
			return $result;
		}
	}
}