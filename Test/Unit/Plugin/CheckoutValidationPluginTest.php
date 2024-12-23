<?php
/**
 * Copyright © 2024 LucasZit. All rights reserved.
 * See COPYING.txt for license details.
 *
 * @author Lucas Pereira
 */

declare(strict_types=1);

namespace LucasZit\LockCheckout\Test\Unit\Plugin;

use LucasZit\LockCheckout\Model\AdminConfiguration;
use LucasZit\LockCheckout\Plugin\CheckoutValidationPlugin;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\Message\ManagerInterface;
use PHPUnit\Framework\TestCase;
use Magento\Framework\App\Action\Action;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\Api\AttributeInterface;

/**
 * Class CheckoutValidationPluginTest for Unit Tests
 *
 * @coversDefaultClass \LucasZit\LockCheckout\Plugin\CheckoutValidationPlugin
 */
class CheckoutValidationPluginTest extends TestCase
{
    /** @var CheckoutValidationPlugin */
    private CheckoutValidationPlugin $instance;

    /** @var CustomerSession */
    private CustomerSession $customerSessionMock;

    /** @var CustomerRepositoryInterface */
    private CustomerRepositoryInterface $customerRepositoryInterfaceMock;

    /** @var AdminConfiguration */
    private AdminConfiguration $adminConfigurationMock;

    /** @var ManagerInterface */
    private ManagerInterface $messageManagerMock;

    /** @var Action */
    private Action $actionMock;

    /** @var CustomerInterface */
    private CustomerInterface $customerInterfaceMock;

    /** @var AttributeInterface */
    private AttributeInterface $attributeInterfaceMock;

    /**
     * Setup Tests
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->customerSessionMock = $this->createMock(CustomerSession::class);
        $this->customerRepositoryInterfaceMock = $this->createMock(CustomerRepositoryInterface::class);
        $this->adminConfigurationMock = $this->createMock(AdminConfiguration::class);
        $this->messageManagerMock = $this->createMock(ManagerInterface::class);

        $this->actionMock = $this->createMock(Action::class);
        $this->customerInterfaceMock = $this->createMock(CustomerInterface::class);
        $this->attributeInterfaceMock = $this->createMock(AttributeInterface::class);

        $this->instance = new CheckoutValidationPlugin(
            $this->customerSessionMock,
            $this->customerRepositoryInterfaceMock,
            $this->adminConfigurationMock,
            $this->messageManagerMock
        );
    }

    /**
     * TestCanCreate
     *
     * @covers ::__construct
     *
     * return void
     */
    public function testCanCreate(): void
    {
        $this->assertInstanceOf(CheckoutValidationPlugin::class, $this->instance);
    }

    /**
     * ArrangeEqualsMockTestsFragments
     *
     * @return void
     */
    public function arrangeEqualsMockTestsFragments(): void
    {
        $this->adminConfigurationMock
            ->expects($this->exactly(1))
            ->method('getModuleEnable')
            ->willReturn('1');

        $this->customerSessionMock
            ->expects($this->exactly(1))
            ->method('isLoggedIn')
            ->willReturn(1);

        $this->customerSessionMock
            ->expects($this->exactly(1))
            ->method('getCustomerId')
            ->willReturn(1);

        $this->customerRepositoryInterfaceMock
            ->expects($this->exactly(1))
            ->method('getById')
            ->with(1)
            ->willReturn($this->customerInterfaceMock);

        $this->customerInterfaceMock
            ->expects($this->exactly(1))
            ->method('getCustomAttribute')
            ->with('lock_checkout')
            ->willReturn($this->attributeInterfaceMock);
    }

    /**
     * TestBeforeDispatchWhenModuleIsDisable
     *
     * @covers ::beforeDispatch
     *
     * @return void
     */
    public function testBeforeDispatchWhenModuleIsDisable(): void
    {
        // Arrange
        $this->adminConfigurationMock
            ->expects($this->exactly(1))
            ->method('getModuleEnable')
            ->willReturn('0');

        // Act
        $result = $this->instance->beforeDispatch($this->actionMock);

        // Assert
        $this->assertSame(null, $result);
    }

    /**
     * TestBeforeDispatchWhenCustomerIsNotLoggedIn
     *
     * @covers ::beforeDispatch
     *
     * @return void
     */
    public function testBeforeDispatchWhenCustomerIsNotLoggedIn(): void
    {
        // Arrange
        $this->adminConfigurationMock
            ->expects($this->exactly(1))
            ->method('getModuleEnable')
            ->willReturn('1');

        $this->customerSessionMock
            ->expects($this->exactly(1))
            ->method('isLoggedIn')
            ->willReturn(0);

        // Act
        $result = $this->instance->beforeDispatch($this->actionMock);

        // Assert
        $this->assertSame(null, $result);
    }

    /**
     * TestBeforeDispatchWhenIsNotCustomerLocked
     *
     * @covers ::beforeDispatch
     *
     * @return void
     */
    public function testBeforeDispatchWhenIsNotCustomerLocked(): void
    {
        // Arrange
        $this->arrangeEqualsMockTestsFragments();

        $this->attributeInterfaceMock
            ->expects($this->exactly(1))
            ->method('getValue')
            ->willReturn('0');

        // Act
        $result = $this->instance->beforeDispatch($this->actionMock);

        // Assert
        $this->assertSame(null, $result);
    }
}
