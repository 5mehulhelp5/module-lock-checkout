<?php
/**
 * Copyright © 2024 LucasZit. All rights reserved.
 * See COPYING.txt for license details.
 *
 * @author Lucas Pereira
 */

declare(strict_types=1);

namespace LucasZit\LockCheckout\Plugin;

use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use LucasZit\LockCheckout\Model\AdminConfiguration;

/**
 * Class AutoAssignLockCheckoutPlugin to auto assign lock checkout custom attribute to a customer
 */
class AutoAssignLockCheckoutPlugin
{
    /**
     * AutoAssignLockCheckoutPlugin Constructor
     *
     * @param AdminConfiguration $adminConfiguration
     */
    public function __construct(
        private readonly AdminConfiguration $adminConfiguration
    ) {}

    /**
     * Before create account plugin
     *
     * @param AccountManagementInterface $subject
     * @param CustomerInterface $customer
     * @param string $passwordHash
     * @param string|null $redirectUrl
     * @return array
     */
    public function beforeCreateAccount(
        AccountManagementInterface $subject,
        CustomerInterface $customer,
        string $passwordHash,
        ?string $redirectUrl = null
    ): array {

        if ($this->adminConfiguration->getModuleEnable() && $this->adminConfiguration->getAutoAssignLockCheckout()) {
            $customer->setCustomAttribute('lock_checkout', 1);
        }

        return [$customer, $passwordHash, $redirectUrl];
    }
}
