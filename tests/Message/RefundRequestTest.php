<?php

namespace Omnipay\Payeer\Message;

use Guzzle\Plugin\Mock\MockPlugin;
use Omnipay\Tests\TestCase;

class RefundRequestTest extends TestCase
{

    /**
     * @var RefundRequest
     */
    private $request;

    protected function setUp()
    {
        $mockPlugin = new MockPlugin();
        $mockPlugin->addResponse($this->getMockHttpResponse('RefundSuccess.txt'));
        $httpClient = $this->getHttpClient();
        $httpClient->addSubscriber($mockPlugin);

        $this->request = new RefundRequest($httpClient, $this->getHttpRequest());

        $this->request->setPayeeAccount('PayeeAccount');
        $this->request->setAmount('10.00');
        $this->request->setDescription('Description');
        $this->request->setAccount('Account');
        $this->request->setApiSecret('ApiSecret');
        $this->request->setApiId('ApiId');
        $this->request->setCurrency('Currency');
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $expectedData = [
            'apiPass' => 'ApiSecret',
            'apiId' => 'ApiId',
            'account' => 'Account',
            'sum' => '10.00',
            'curIn' => 'CURRENCY',
            'curOut' => 'CURRENCY',
            'to' => 'PayeeAccount',
            'comment' => 'Description',
            'action' => 'transfer',
        ];

        $this->assertEquals($expectedData, $data);
    }

    public function testSendSuccess()
    {
        $response = $this->request->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testSendError()
    {
        $mockPlugin = new MockPlugin();
        $mockPlugin->addResponse($this->getMockHttpResponse('RefundError.txt'));
        $httpClient = $this->getHttpClient();
        $httpClient->addSubscriber($mockPlugin);

        $this->request = new RefundRequest($httpClient, $this->getHttpRequest());
        $this->request->setPayeeAccount('PayeeAccount');
        $this->request->setAmount('10.00');
        $this->request->setDescription('Description');
        $this->request->setAccount('Account');
        $this->request->setApiSecret('ApiSecret');
        $this->request->setApiId('ApiId');
        $this->request->setCurrency('Currency');

        $response = $this->request->send();
        $this->assertFalse($response->isSuccessful());
    }

}