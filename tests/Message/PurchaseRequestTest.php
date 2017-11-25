<?php

namespace Omnipay\Payeer\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{

    /**
     * @var PurchaseRequest
     */
    private $request;

    protected function setUp()
    {
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setAccount('Account');
        $this->request->setCurrency('Currency');
        $this->request->setAmount('10.00');
        $this->request->setReturnUrl('ReturnUrl');
        $this->request->setCancelUrl('CancelUrl');
        $this->request->setNotifyUrl('NotifyUrl');
        $this->request->setTransactionId(1);
        $this->request->setDescription('Description');
        $this->request->setShopId('ShopId');
        $this->request->setShopSecret('ShopSecret');
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $expectedData = [
            'm_shop' => 'ShopId',
            'm_orderid' => 1,
            'm_amount' => '10.00',
            'm_curr' => 'CURRENCY',
            'm_desc' => base64_encode('Description'),
            'm_sign' => 'E0251D783F054E565F542CDA0E2A785FF2C2817660F8FEFC291552E9CCCDD526',
        ];

        $this->assertEquals($expectedData, $data);
    }

    public function testSendSuccess()
    {
        $response = $this->request->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertEquals('//payeer.com/api/merchant/m.php', $response->getRedirectUrl());
        $this->assertEquals('POST', $response->getRedirectMethod());
    }


}