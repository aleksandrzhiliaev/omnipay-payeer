<?php

namespace Omnipay\Payeer;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase([
            'amount' => '0.1',
            'currency' => 'USD',
            'transactionId' => 123,
            'description' => 'Order: 123',
            'cancelUrl' => 'https://url.com/cancel',
            'returnUrl' => 'https://url.com/return',
            'notifyUrl' => 'https://url.com/notify',
        ]);

        $this->assertInstanceOf('Omnipay\Payeer\Message\PurchaseRequest', $request);
        $this->assertSame('0.10', $request->getAmount());
    }

    public function testCompletePurchase()
    {
        $request = $this->gateway->completePurchase();

        $this->assertInstanceOf('\Omnipay\Payeer\Message\CompletePurchaseRequest', $request);
    }

    public function testRefund()
    {
        $request = $this->gateway->refund([
            'payeeAccount' => 'P12345678',
            'amount' => 0.1,
            'description' => 'Testing Payeer',
            'currency' => 'USD',
        ]);

        $this->assertInstanceOf('\Omnipay\Payeer\Message\RefundRequest', $request);
        $this->assertSame('P12345678', $request->getPayeeAccount());
    }

}