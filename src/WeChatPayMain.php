<?php

namespace Vikin\WeChatPay;

use Illuminate\Support\Facades\App;

/**
 * Class WeChatPayMain
 * @package Vikin\WeChatPay
 */
class WeChatPayMain
{
    /**
     * @var
     */
    protected $WxPayUnifiedOrder;

    /**
     * WeChatPayMain constructor.
     */
    public function __construct()
    {
        $this->WxPayUnifiedOrder = App::make('Vikin\WeChatPay\Resource\Lib\WxPayUnifiedOrder');
    }

    /**
     * 扫码支付
     * @return mixed
     */
    public function QrCodePay()
    {
        $Native = App::make('Vikin\WeChatPay\Native');
        $url = App::call([$Native, 'mode_one'], ['input'=>$this->WxPayUnifiedOrder]);

        return $url;
    }

    /**
     * 扫码支付回调函数
     * @throws \Exception
     */
    public function Notify($suCallback, $erCallback)
    {
        $notifyData = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';

        if (empty($notifyData)) {
            $notifyData = file_get_contents('php://input');
        }

        if ($notifyData != '') {
            libxml_disable_entity_loader(true);
            $notifyData = json_decode(json_encode(simplexml_load_string($notifyData, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

            if ($notifyData['return_code'] == 'SUCCESS' && $notifyData['result_code'] == 'SUCCESS') { //支付成功
                try {
                    //支付成功,开启事务,你要干些什么都写这里,例如增加余额的操作什么的
                    call_user_func($suCallback,$notifyData);
                } catch (\Exception $e) {
                    //如果try里面的东西出现问题的话，进行数据库回滚
                    call_user_func($erCallback, $notifyData);
                    throw $e;
                }
                return "SUCCESS";
            }
        } else {
            return false; //支付失败
        }
    }

    /**
     * 内容
     * @param $body
     */
    public function setBody($body)
    {
        $this->WxPayUnifiedOrder->SetBody($body);
    }

    /**
     * 附加
     * @param $attach
     */
    public function setAttach($attach)
    {
        $this->WxPayUnifiedOrder->SetAttach($attach);
    }

    /**
     * @param $outTradeNo
     */
    public function setOutTradeNo($outTradeNo)
    {
        $this->WxPayUnifiedOrder->SetOut_trade_no($outTradeNo);
    }

    /**
     * 总金额,金额需要是实际金额的100倍
     * @param $totalFee
     */
    public function setTotalFee($totalFee)
    {
        $this->WxPayUnifiedOrder->SetTotal_fee($totalFee * 100);
    }

    /**
     * 开始时间
     * @param $timeStart
     */
    public function setTimeStart($timeStart)
    {
        $this->WxPayUnifiedOrder->SetTime_start($timeStart);
    }

    /**
     * 到期时间
     * @param $timeExpire
     */
    public function setTimeExpire($timeExpire)
    {
        $this->WxPayUnifiedOrder->SetTime_expire($timeExpire);
    }

    /**
     * 商品标签
     * @param $goodsTag
     */
    public function setGoodsTag($goodsTag)
    {
        $this->WxPayUnifiedOrder->SetGoods_tag($goodsTag);
    }

    /**
     * 通知地址
     * @param $notifyUrl
     */
    public function setNotifyUrl($notifyUrl)
    {
        $this->WxPayUnifiedOrder->SetNotify_url($notifyUrl);
    }

    /**
     * 支付类型(扫码支付)
     * @param $tradeType
     */
    public function setTradeType($tradeType)
    {
        $this->WxPayUnifiedOrder->SetTrade_type($tradeType);
    }

    /**
     * 商品id
     * @param $productId
     */
    public function setProductId($productId)
    {
        $this->WxPayUnifiedOrder->SetProduct_id($productId);
    }
}