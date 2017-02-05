<?php

namespace Omnipay\Payeer\Message;

use Omnipay\Common\Message\AbstractRequest as OmnipayRequest;

abstract class AbstractRequest extends OmnipayRequest
{
    protected $liveMerchantEndpoint = '//payeer.com/api/merchant/m.php';
    protected $liveApiEndpoint = 'https://payeer.com/ajax/api/api.php';


    protected function getMerchantEndpoint()
    {
        return $this->liveMerchantEndpoint;
    }
}
