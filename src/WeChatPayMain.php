<?php

namespace Vikin\WeChatPay;

use Illuminate\Support\Facades\App;

class WeChatPayMain
{
    //扫码支付
    public function QrCodePay ()
    {
        $Native = App::make('Vikin\WeChatPay\Native');
        $res = App::call([$Native, 'mode_one']);

        return $res;
    }

    public function Notify ()
    {
        $PayNotifyCallBack = App::make('Vikin\WeChatPay\PayNotifyCallBack');

        App::call([$PayNotifyCallBack, 'Handle'], ['needSign'=>false]);
    }



}