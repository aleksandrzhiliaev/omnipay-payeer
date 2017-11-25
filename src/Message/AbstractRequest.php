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

    public function getAccount()
    {
        return $this->getParameter('account');
    }

    public function setAccount($value)
    {
        return $this->setParameter('account', $value);
    }

    public function getShopId()
    {
        return $this->getParameter('shop_id');
    }

    public function setShopId($value)
    {
        return $this->setParameter('shop_id', $value);
    }

    public function getShopSecret()
    {
        return $this->getParameter('shop_secret');
    }

    public function setShopSecret($value)
    {
        return $this->setParameter('shop_secret', $value);
    }

    public function getApiId()
    {
        return $this->getParameter('api_id');
    }

    public function setApiId($value)
    {
        return $this->setParameter('api_id', $value);
    }

    public function getApiSecret()
    {
        return $this->getParameter('api_secret');
    }

    public function setApiSecret($value)
    {
        return $this->setParameter('api_secret', $value);
    }

    public function getPayeeAccount()
    {
        return $this->getParameter('payeeAccount');
    }

    public function setPayeeAccount($value)
    {
        return $this->setParameter('payeeAccount', $value);
    }

}
