<?php
/**
 * @author    Louis Bataillard <info@mobweb.ch>
 * @package    MobWeb_CustomBodyClasses
 * @copyright    Copyright (c) MobWeb GmbH (https://mobweb.ch)
 */

namespace MobWeb\CustomBodyClasses\Observer\Adminhtml;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\View\Page\Config;
use Magento\Store\Model\StoreManagerInterface;

class LayoutLoadBefore implements ObserverInterface
{
    protected $config;
    protected $storeManager;

    /**
     * @param Config $config
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Config $config,
        StoreManagerInterface $storeManager
    ) {
        $this->config = $config;
        $this->storeManager = $storeManager;
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

        return $customBodyClasses;
    }
}
