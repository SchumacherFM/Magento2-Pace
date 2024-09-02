<?php
/**
 * @category    SchumacherFM_Pace
 * @package     Model
 * @author      Cyrill at Schumacher dot fm / @SchumacherFM
 * @copyright   Copyright (c)
 * @license     The MIT License (MIT)
 */
namespace SchumacherFM\Pace\Model;

class Config implements ConfigInterface
{
    /**
     * Get Custom CSS config
     *
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        protected \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
    }

    /**
     * Get Theme file config
     *
     * @param string $type
     * @return string
     */
    public function getThemeFileName($type = 'backend')
    {
        return $this->scopeConfig->getValue(
            'system/schumacherfm_pace/' . $type . '_pace_theme',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get Theme Color config
     *
     * @param string $type
     * @return string
     */
    public function getThemeColor($type = 'backend')
    {
        return $this->scopeConfig->getValue(
            'system/schumacherfm_pace/' . $type . '_pace_color',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get Custom CSS config
     *
     * @param string $type
     * @return string
     */
    public function getCustomCSS($type = 'backend')
    {
        return $this->scopeConfig->getValue(
            'system/schumacherfm_pace/' . $type . '_custom_css',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get is frontend enabled config
     *
     * @return bool
     */
    public function isFrontendEnabled()
    {
        return $this->scopeConfig->isSetFlag(
            'system/schumacherfm_pace/frontend_enable',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
