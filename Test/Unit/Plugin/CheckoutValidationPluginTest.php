<?php

declare(strict_types=1);

namespace LucasZit\LockCheckout\Test\Unit\Plugin;

use LucasZit\LockCheckout\Model\AdminConfiguration;
use LucasZit\LockCheckout\Plugin\CheckoutValidationPlugin;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\Message\ManagerInterface;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory as OrderCollectionFactory;
use PHPUnit\Framework\TestCase;
use Magento\Framework\App\Action\Action;

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
    private CustomerRepositoryInterface $customerRepositoryMock;

    /** @var AdminConfiguration */
    private AdminConfiguration $adminConfigurationMock;

    /** @var ManagerInterface */
    private ManagerInterface $messageManagerMock;

    /** @var OrderCollectionFactory */
    private OrderCollectionFactory $orderCollectionFactoryMock;

    /**
     * Setup Tests
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->customerSessionMock = $this->createMock(CustomerSession::class);
        $this->customerRepositoryMock = $this->createMock(CustomerRepositoryInterface::class);
        $this->adminConfigurationMock = $this->createMock(AdminConfiguration::class);
        $this->messageManagerMock = $this->createMock(ManagerInterface::class);
        $this->orderCollectionFactoryMock = $this->createMock(OrderCollectionFactory::class);

        $this->instance = new CheckoutValidationPlugin(
            $this->customerSessionMock,
            $this->customerRepositoryMock,
            $this->adminConfigurationMock,
            $this->messageManagerMock,
            $this->orderCollectionFactoryMock
        );
    }

    /**
     * TestCanCreate
     *
     * @covers ::__construct
     *
     * @return void
     */
    public function testCanCreate(): void
    {
        $this->assertInstanceOf(CheckoutValidationPlugin::class, $this->instance);
    }

    /**
     * TestBeforeDispatchWhenModuleIsDisabled
     *
     * @covers ::beforeDispatch
     *
     * @return void
     */
    public function testBeforeDispatchWhenModuleIsDisabled(): void
    {
        // Arrange
        $this->adminConfigurationMock->expects($this->once())
            ->method('getModuleEnable')
            ->willReturn('0');

        $actionMock = $this->createMock(Action::class);

        // Act
        $result = $this->instance->beforeDispatch($actionMock);

        // Assert
        $this->assertNull($result);
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
        $this->adminConfigurationMock->expects($this->once())
            ->method('getModuleEnable')
            ->willReturn('1');

        $this->customerSessionMock->expects($this->once())
            ->method('isLoggedIn')
            ->willReturn(false);

        $actionMock = $this->createMock(Action::class);

        // Act
        $result = $this->instance->beforeDispatch($actionMock);

        // Assert
        $this->assertNull($result);
    }
}
