<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Sales\Test\Unit\Model\Order;

/**
 * Unit test for payment adapter.
 */
class PaymentAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Sales\Model\Order\PaymentAdapter
     */
    private $subject;

    /**
     * @var \Magento\Sales\Api\Data\OrderInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $orderMock;

    /**
     * @var \Magento\Sales\Api\Data\CreditmemoInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $creditmemoMock;

    /**
     * @var \Magento\Sales\Model\Order\Creditmemo\RefundOperation|\PHPUnit_Framework_MockObject_MockObject
     */
    private $refundOperationMock;

    protected function setUp()
    {
        $this->orderMock = $this->getMockForAbstractClass(
            'Magento\Sales\Api\Data\OrderInterface',
            [],
            '',
            false,
            false,
            true,
            []
        );
        $this->creditmemoMock = $this->getMockForAbstractClass(
            'Magento\Sales\Api\Data\CreditmemoInterface',
            [],
            '',
            false,
            false,
            true,
            []
        );
        $this->refundOperationMock = $this->getMock(
            'Magento\Sales\Model\Order\Creditmemo\RefundOperation',
            [],
            [],
            '',
            false
        );
        $this->subject = new \Magento\Sales\Model\Order\PaymentAdapter(
            $this->refundOperationMock
        );
    }

    public function testRefund()
    {
        $isOnline = true;
        $this->refundOperationMock->expects($this->once())
            ->method('execute')
            ->with($this->creditmemoMock, $this->orderMock, $isOnline)
            ->willReturn($this->orderMock);
        $this->assertEquals(
            $this->orderMock,
            $this->subject->refund($this->creditmemoMock, $this->orderMock, $isOnline)
        );
    }
}
