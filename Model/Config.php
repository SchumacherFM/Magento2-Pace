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
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * @param string $type
     *
     * @return string
     */
    public function getThemeFileName($type = 'backend') {
        return $this->_scopeConfig->getValue(
            'system/schumacherfm_pace/' . $type . '_pace_theme',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @param string $type
     * @return string
     */
    public function getThemeColor($type = 'backend') {
        return $this->_scopeConfig->getValue(
            'system/schumacherfm_pace/' . $type . '_pace_color',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @param string $type
     *
     * @return string
     */
    public function getCustomCSS($type = 'backend') {
        return $this->_scopeConfig->getValue(
            'system/schumacherfm_pace/' . $type . '_custom_css',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return bool
     */
    public function isFrontendEnabled() {
        return $this->_scopeConfig->isSetFlag(
            'system/schumacherfm_pace/frontend_enable',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
