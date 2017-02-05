<?php

namespace Omnipay\Payeer\Message;


class PurchaseRequest extends AbstractRequest
{
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

    public function getData()
    {
        $this->validate('account', 'currency', 'amount', 'description');

        $arHash = [
            $this->getShopId(),
            $this->getTransactionId(),
            $this->getAmount(),
            $this->getCurrency(),
            base64_encode($this->getDescription()),
            $this->getShopSecret(),
        ];
        $sign = strtoupper(hash('sha256', implode(":", $arHash)));

        $data['m_shop'] = $this->getShopId();
        $data['m_orderid'] = $this->getTransactionId();
        $data['m_amount'] = $this->getAmount();
        $data['m_curr'] = $this->getCurrency();
        $data['m_desc'] = base64_encode($this->getDescription());
        $data['m_sign'] = $sign;

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data, $this->getMerchantEndpoint());
    }
}
