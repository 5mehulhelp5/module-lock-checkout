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
use LucasZit\LockCheckout\Plugin\AutoAssignLockCheckoutPlugin;
use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class AutoAssignLockCheckoutPluginTest for Unit Tests
 *
 * @coversDefaultClass \LucasZit\LockCheckout\Plugin\AutoAssignLockCheckoutPlugin
 */
class AutoAssignLockCheckoutPluginTest extends TestCase
{
    /** @var MockObject|AdminConfiguration */
    private AdminConfiguration|MockObject $adminConfigurationMock;

    /** @var AutoAssignLockCheckoutPlugin */
    private AutoAssignLockCheckoutPlugin $plugin;

    /**
     * Setup Tests
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->adminConfigurationMock = $this->createMock(AdminConfiguration::class);
        $this->plugin = new AutoAssignLockCheckoutPlugin($this->adminConfigurationMock);
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
        $this->assertInstanceOf(AdminConfiguration::class, $this->adminConfigurationMock);
    }

    /**
     * TestBeforeCreateAccountAssignsLockCheckoutAttribute
     *
     * @covers ::beforeCreateAccount
     *
     * @return void
     */
    public function testBeforeCreateAccountAssignsLockCheckoutAttribute(): void
    {
        $customerMock = $this->createMock(CustomerInterface::class);
        $accountManagementMock = $this->createMock(AccountManagementInterface::class);

        $passwordHash = 'hashedPassword';
        $redirectUrl = 'http://example.com';

        $this->adminConfigurationMock->method('getModuleEnable')->willReturn('1');
        $this->adminConfigurationMock->method('getAutoAssignLockCheckout')->willReturn('1');

        $customerMock->expects($this->once())
            ->method('setCustomAttribute')
            ->with('lock_checkout', 1);

        $result = $this->plugin->beforeCreateAccount(
            $accountManagementMock,
            $customerMock,
            $passwordHash,
            $redirectUrl
        );

        $this->assertEquals([$customerMock, $passwordHash, $redirectUrl], $result);
    }

    /**
     * TestBeforeCreateAccountDoesNotAssignLockCheckoutAttributeWhenModuleDisabled
     *
     * @covers ::beforeCreateAccount
     *
     * @return void
     */
    public function testBeforeCreateAccountDoesNotAssignLockCheckoutAttributeWhenModuleDisabled(): void
    {
        $customerMock = $this->createMock(CustomerInterface::class);
        $accountManagementMock = $this->createMock(AccountManagementInterface::class);

        $passwordHash = 'hashedPassword';
        $redirectUrl = 'http://example.com';

        $this->adminConfigurationMock->method('getModuleEnable')->willReturn('0');

        $customerMock->expects($this->never())
            ->method('setCustomAttribute');

        $result = $this->plugin->beforeCreateAccount(
            $accountManagementMock,
            $customerMock,
            $passwordHash,
            $redirectUrl
        );

        $this->assertEquals([$customerMock, $passwordHash, $redirectUrl], $result);
    }

    /**
     * TestBeforeCreateAccountDoesNotAssignLockCheckoutAttributeWhenAutoAssignDisabled
     *
     * @covers ::beforeCreateAccount
     *
     * @return void
     */
    public function testBeforeCreateAccountDoesNotAssignLockCheckoutAttributeWhenAutoAssignDisabled(): void
    {
        $customerMock = $this->createMock(CustomerInterface::class);
        $accountManagementMock = $this->createMock(AccountManagementInterface::class);

        $passwordHash = 'hashedPassword';
        $redirectUrl = 'http://example.com';

        $this->adminConfigurationMock->method('getModuleEnable')->willReturn('1');
        $this->adminConfigurationMock->method('getAutoAssignLockCheckout')->willReturn('0');

        $customerMock->expects($this->never())
            ->method('setCustomAttribute');

        $result = $this->plugin->beforeCreateAccount(
            $accountManagementMock,
            $customerMock,
            $passwordHash,
            $redirectUrl
        );

        $this->assertEquals([$customerMock, $passwordHash, $redirectUrl], $result);
    }
}
