<?php

namespace Omnipay\Payeer\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class CompletePurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    public function isSuccessful()
    {
        return ($this->data['m_status'] == 'success') ? true : false;
    }

    public function isCancelled()
    {
        return ($this->data['m_status'] != 'success') ? true : false;
    }

    public function isRedirect()
    {
        return false;
    }

    public function getRedirectUrl()
    {
        return null;
    }

    public function getRedirectMethod()
    {
        return null;
    }

    public function getRedirectData()
    {
        return null;
    }

    public function getTransactionId()
    {
        return intval($this->data['m_orderid']);
    }

    public function getAmount()
    {
        return floatval($this->data['m_amount']);
    }

    public function getCurrency()
    {
        return $this->data['m_curr'];
    }

    public function getMessage()
    {
        return null;
    }
}
