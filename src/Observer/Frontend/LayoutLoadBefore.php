<?php
/**
 * @author    Louis Bataillard <info@mobweb.ch>
 * @package    MobWeb_CustomBodyClasses
 * @copyright    Copyright (c) MobWeb GmbH (https://mobweb.ch)
 */

namespace MobWeb\CustomBodyClasses\Observer\Frontend;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\View\Page\Config;
use Narf\Toolbox\Helper\Customer as CustomerHelper;

class LayoutLoadBefore implements ObserverInterface
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var StoreManager
     */
    protected $storeManager;

    /**
     * @var CustomerHelper
     */
    protected $customerHelper;

    /**
     * @param Config $config
     * @param CustomerHelper $customerHelper
     */
    public function __construct(
        Config $config,
        CustomerHelper $customerHelper
    ) {
        $this->config = $config;
        $this->customerHelper = $customerHelper;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        foreach ($this->getCustomBodyClasses() as $customBodyClass) {
            $this->config->addBodyClass($customBodyClass);
        }
    }

    /**
     * @return array
     */
    private function getCustomBodyClasses(): array
    {
        $customBodyClasses = [];

        $customBodyClasses[] = $this->customerHelper->isCurrentCustomerLoggedIn() ? 'customer-logged-in' : 'customer-not-logged-in';

        return $customBodyClasses;
    }
}

