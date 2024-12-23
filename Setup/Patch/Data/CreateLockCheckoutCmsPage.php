<?php
/**
 * Copyright © 2024 LucasZit. All rights reserved.
 * See COPYING.txt for license details.
 *
 * @author Lucas Pereira
 */

declare(strict_types=1);

namespace LucasZit\LockCheckout\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Cms\Model\PageFactory;

/**
 * Class CreateLockCheckoutCmsPage to create a CMS page for redirect
 */
class CreateLockCheckoutCmsPage implements DataPatchInterface
{
    /**
     * CreateLockCheckoutCmsPage Constructor
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param PageFactory $pageFactory
     * @param PageRepositoryInterface $pageRepository
     */
    public function __construct(
        private readonly ModuleDataSetupInterface $moduleDataSetup,
        private readonly PageFactory $pageFactory,
        private readonly PageRepositoryInterface $pageRepository
    ) {}

    /**
     * Apply the data patch
     */
    public function apply(): void
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $cmsPageData = [
            'title' => __('Lock Checkout Message'),
            'identifier' => 'lock-checkout-message',
            'content' => '<h3>Your account is locked for checkout. Please contact support.</h3>',
            'is_active' => 1,
            'stores' => [0],
            'page_layout' => '1column',
        ];

        $cmsPage = $this->pageFactory->create();
        $cmsPage->setData($cmsPageData);
        $this->pageRepository->save($cmsPage);

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * Get patch dependencies
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * Get aliases
     */
    public function getAliases(): array
    {
        return [];
    }
}
