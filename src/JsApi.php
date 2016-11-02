<?php
namespace Vikin\WeChatPay;

use Illuminate\Support\Facades\App;

class JsApi
{
    //统一下单
    public function GenerateOrders($orderData)
    {
        $WxPayApi = App::make('Vikin\WeChatPay\Resource\Lib\WxPayApi');
        $order = App::call([$WxPayApi, 'unifiedOrder'], ['inputObj' => $orderData]);

        $JsApiPay = App::make('Vikin\WeChatPay\Resource\JsApiPay');
        $jsApiParameters = App::call([$JsApiPay, 'GetJsApiParameters'], ['UnifiedOrderResult' => $order]);


        //获取共享收货地址js函数参数
        $editAddress = App::call([$JsApiPay, 'GetEditAddressParameters']);

        echo "<script>
                function jsApiCall()
                    {
                        WeixinJSBridge.invoke(
                            'getBrandWCPayRequest',
                             $jsApiParameters,
                            function(res){
                                WeixinJSBridge.log(res.err_msg);
                                
                                //res.err_code    支付成功:undefined                        //取消支付:undifined
                                //res.err_desc    支付成功:undefined                        //取消支付:undefined
                                //res.err_msg     支付成功:get_brand_wcpay_request:ok       //取消支付:get_brand_wcpay_request:cancel
                                
                                if(res.err_msg === 'get_brand_wcpay_request:ok'){
                                    location.href = '".config('WeChatConfig.GZ_SUCCESS')."';
                                }else if(res.err_msg === 'get_brand_wcpay_request:cancel'){
                                    location.href = '".config('WeChatConfig.GZ_CANCEL')."';
                                }
                            }
                        );
                    }
                
                    function callpay()
                    {
                        if (typeof WeixinJSBridge == 'undefined'){
                            if( document.addEventListener ){
                                document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                            }else if (document.attachEvent){
                                document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
                                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                            }
                        }else{
                            jsApiCall();
                        }
                    }
                    callpay();
              </script>";
    }
}