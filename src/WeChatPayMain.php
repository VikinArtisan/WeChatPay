<?php

namespace Vikin\WeChatPay;

use Illuminate\Support\Facades\App;

class WeChatPayMain
{
    /**
     * 扫码支付
     * @return mixed
     */
    public function QrCodePay()
    {
        $Native = App::make('Vikin\WeChatPay\Native');
        $res = App::call([$Native, 'mode_one']);

        return $res;
    }

    /**
     * 扫码支付回调函数
     * @throws \Exception
     */
    public function Notify()
    {
        $notifyData = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';

        if (empty($notifyData)) {
            $notifyData = file_get_contents('php://input');
        }

        if ($notifyData != '') {
            libxml_disable_entity_loader(true);
            $notifyData = json_decode(json_encode(simplexml_load_string($notifyData, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

            if ($notifyData['return_code'] == 'SUCCESS' && $notifyData['result_code'] == 'SUCCESS') { //支付成功
                try { //开始事务
                    //支付成功，你要干些什么都写这里，例如增加余额的操作什么的

                } catch (Exception $e) {
                    //如果try里面的东西出现问题的话，进行数据库回滚
                    throw $e;
                }
                echo "SUCCESS";
            }
        } else {
            $ret = false; //支付失败
        }
    }

}