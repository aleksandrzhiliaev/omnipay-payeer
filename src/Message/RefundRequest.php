<?php

namespace Omnipay\Payeer\Message;

class RefundRequest extends AbstractRequest
{
    protected $endpoint = 'https://payeer.com/ajax/api/api.php';

    public function getData()
    {
        $this->validate('payeeAccount', 'amount', 'currency', 'description');

        $data['apiPass'] = $this->getApiSecret();
        $data['apiId'] = $this->getApiId();
        $data['account'] = $this->getAccount();
        $data['sum'] = $this->getAmount();
        $data['curIn'] = $this->getCurrency();
        $data['curOut'] = $this->getCurrency();
        $data['to'] = $this->getPayeeAccount();
        $data['comment'] = $this->getDescription();
        $data['action'] = 'transfer';

        return $data;
    }

    public function sendData($data)
    {
        $httpResponse = $this->httpClient->post($this->endpoint, null, $data)->send();
        $jsonResponse = json_decode($httpResponse->getBody(true));

        return $this->response = new RefundResponse($this, $jsonResponse);
    }

}
