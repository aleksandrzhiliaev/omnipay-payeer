<?php

namespace Omnipay\Payeer\Message;

use Omnipay\Tests\TestCase;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class CompletePurchaseRequestTest extends TestCase
{
    public function testSendSuccess()
    {
        $httpRequest = new HttpRequest([], [
            'm_operation_id' => '292915150',
            'm_operation_ps' => '2609',
            'm_operation_date' => '22.01.2017 18:31:07',
            'm_operation_pay_date' => '22.01.2017 18:31:19',
            'm_shop' => '125875499',
            'm_orderid' => '16088',
            'm_amount' => '19.85',
            'm_curr' => 'USD',
            'm_desc' => 'T3JkZXI6IDE2MDg4',
            'm_status' => 'success',
            'm_sign' => '735FD542C4942F10146C90CA9C681CE0F1D24EED94D365A1AEC47C46FC9EEEB9',
            'summa_out' => '19.85',
            'transfer_id' => '292915284',
            'client_account' => 'P3263200',
            'client_email' => 'example@example.com',
        ]);

        $request = new CompletePurchaseRequest($this->getHttpClient(), $httpRequest);
        $request->setCurrency('USD');
        $request->setShopSecret('secret');
        $response = $request->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('16088', $response->getTransactionId());
        $this->assertEquals('19.85', $response->getAmount());
        $this->assertEquals('USD', $response->getCurrency());
    }

}