<?php

namespace Vikin\WeChatPay\Resource\Log;

interface ILogHandler
{
    public function write($msg);

}