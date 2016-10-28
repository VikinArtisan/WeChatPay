<?php

namespace Vikin\WeChatPay;

use Illuminate\Support\Facades\Facade;

class WeChatPay extends Facade
{
    protected static function getFacadeAccessor ()
    {
        return 'WeChatPay';
    }
}