<?php
/**
 * Copyright © 2024 LucasZit. All rights reserved.
 * See COPYING.txt for license details.
 *
 * @author Lucas Pereira
 */

declare(strict_types=1);

namespace LucasZit\LockCheckout\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class AdminConfiguration to retrieve admin configuration values from module Lock Checkout
 */
class AdminConfiguration
{
    public const XML_PATH_MODULE_ENABLE = 'lock_checkout/general/enable_module';
    public const XML_PATH_ORDER_COUNT = 'lock_checkout/general/order_count_threshold';
    public const XML_PATH_ORDER_STATUS_FILTER = 'lock_checkout/general/order_status_filter';
    public const XML_PATH_AUTO_ASSIGN = 'lock_checkout/general/auto_assign';
    public const XML_PATH_LOCK_MESSAGE = 'lock_checkout/general/lock_message';
    public const XML_PATH_REDIRECT_CHECKOUT = 'lock_checkout/general/redirect_on_lock';

    /**
     * AdminConfiguration Constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        private readonly ScopeConfigInterface $scopeConfig
    ) {}

    /**
     * Return module enable value
     *
     * @return string
     */
    public function getModuleEnable(): string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_MODULE_ENABLE, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Return order count value
     *
     * @return int
     */
    public function getOrderCount(): int
    {
        return (int) $this->scopeConfig->getValue(self::XML_PATH_ORDER_COUNT, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Return order status to filter on checkout validation
     *
     * @return string
     */
    public function getOrderStatusFilter(): string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ORDER_STATUS_FILTER, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Return value from auto assign lock checkout for new customer
     *
     * @return string
     */
    public function getAutoAssignLockCheckout(): string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_AUTO_ASSIGN, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Return lock checkout message defined in admin configuration
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_LOCK_MESSAGE, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Returns whether the customer will be redirected to a new page with a message or to the homepage
     * with an error message.
     *
     * @return string
     */
    public function getRedirectOnLockCheckout(): string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_REDIRECT_CHECKOUT, ScopeInterface::SCOPE_STORE);
    }
}
