<?php
/**
 * Copyright © 2024 LucasZit. All rights reserved.
 * See COPYING.txt for license details.
 *
 * @author Lucas Pereira
 */

declare(strict_types=1);

namespace LucasZit\LockCheckout\Test\Unit\Model;

use LucasZit\LockCheckout\Model\AdminConfiguration;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class AdminConfigurationTest for Unit Tests
 *
 * @coversDefaultClass \LucasZit\LockCheckout\Model\AdminConfiguration
 */
class AdminConfigurationTest extends TestCase
{
    /** @var MockObject|ScopeConfigInterface */
    private ScopeConfigInterface|MockObject $scopeConfigMock;

    /** @var AdminConfiguration */
    private AdminConfiguration $adminConfiguration;

    /**
     * Setup Tests
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->scopeConfigMock = $this->createMock(ScopeConfigInterface::class);
        $this->adminConfiguration = new AdminConfiguration($this->scopeConfigMock);
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
        $this->assertInstanceOf(AdminConfiguration::class, $this->adminConfiguration);
    }

    /**
     * TestGetModuleEnable
     *
     * @covers ::getModuleEnable
     *
     * @return void
     */
    public function testGetModuleEnable(): void
    {
        $expectedValue = '1';
        $this->scopeConfigMock->expects($this->once())
            ->method('getValue')
            ->with(AdminConfiguration::XML_PATH_MODULE_ENABLE, ScopeInterface::SCOPE_STORE)
            ->willReturn($expectedValue);

        $this->assertEquals($expectedValue, $this->adminConfiguration->getModuleEnable());
    }

    /**
     * TestGetOrderCount
     *
     * @covers ::getOrderCount
     *
     * @return void
     */
    public function testGetOrderCount(): void
    {
        $expectedValue = 1;
        $this->scopeConfigMock->expects($this->once())
            ->method('getValue')
            ->with(AdminConfiguration::XML_PATH_ORDER_COUNT, ScopeInterface::SCOPE_STORE)
            ->willReturn($expectedValue);

        $this->assertEquals($expectedValue, $this->adminConfiguration->getOrderCount());
    }

    /**
     * TestGetOrderStatusFilter
     *
     * @covers ::getOrderStatusFilter
     *
     * @return void
     */
    public function testGetOrderStatusFilter(): void
    {
        $expectedValue = 'canceled';
        $this->scopeConfigMock->expects($this->once())
            ->method('getValue')
            ->with(AdminConfiguration::XML_PATH_ORDER_STATUS_FILTER, ScopeInterface::SCOPE_STORE)
            ->willReturn($expectedValue);

        $this->assertEquals($expectedValue, $this->adminConfiguration->getOrderStatusFilter());
    }

    /**
     * TestGetAutoAssignLockCheckout
     *
     * @covers ::getAutoAssignLockCheckout
     *
     * @return void
     */
    public function testGetAutoAssignLockCheckout(): void
    {
        $expectedValue = '0';
        $this->scopeConfigMock->expects($this->once())
            ->method('getValue')
            ->with(AdminConfiguration::XML_PATH_AUTO_ASSIGN, ScopeInterface::SCOPE_STORE)
            ->willReturn($expectedValue);

        $this->assertEquals($expectedValue, $this->adminConfiguration->getAutoAssignLockCheckout());
    }

    /**
     * TestGetMessage
     *
     * @covers ::getMessage
     *
     * @return void
     */
    public function testGetMessage(): void
    {
        $expectedValue = 'Customer locked message';
        $this->scopeConfigMock->expects($this->once())
            ->method('getValue')
            ->with(AdminConfiguration::XML_PATH_LOCK_MESSAGE, ScopeInterface::SCOPE_STORE)
            ->willReturn($expectedValue);

        $this->assertEquals($expectedValue, $this->adminConfiguration->getMessage());
    }

    /**
     * TestGetRedirectOnLockCheckout
     *
     * @covers ::getRedirectOnLockCheckout
     *
     * @return void
     */
    public function testGetRedirectOnLockCheckout(): void
    {
        $expectedValue = 'redirect_to_home';
        $this->scopeConfigMock->expects($this->once())
            ->method('getValue')
            ->with(AdminConfiguration::XML_PATH_REDIRECT_CHECKOUT, ScopeInterface::SCOPE_STORE)
            ->willReturn($expectedValue);

        $this->assertEquals($expectedValue, $this->adminConfiguration->getRedirectOnLockCheckout());
    }
}
