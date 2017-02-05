<?php

namespace Omnipay\Payeer;

use Omnipay\Common\AbstractGateway;

/**
 * Gateway Class
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Payeer';
    }

    public function getAccount()
    {
        return $this->getParameter('account');
    }

    public function setAccount($value)
    {
        return $this->setParameter('account', $value);
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

    public function getDefaultParameters()
    {
        return array(
            'account' => '',
            'api_id' => '',
            'api_secret' => '',
            'shop_id' => '',
            'shop_secret' => '',
        );
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Payeer\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Payeer\Message\CompletePurchaseRequest', $parameters);
    }

    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Payeer\Message\RefundRequest', $parameters);
    }
}
