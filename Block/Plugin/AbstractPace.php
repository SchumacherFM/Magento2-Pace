<?php
/**
 * @category    SchumacherFM_Pace
 * @package     Model
 * @author      Cyrill at Schumacher dot fm / @SchumacherFM
 * @copyright   Copyright (c)
 * @license     The MIT License (MIT)
 */
namespace SchumacherFM\Pace\Block\Plugin;

use \Magento\Backend\Block\Page\RequireJs;
use \Magento\Framework\View\Element\AbstractBlock;
use \Magento\Store\Model\StoreManagerInterface;
use \Magento\Framework\View\Element\Template\Context;
use \SchumacherFM\Pace\Model\ConfigInterface;
use \SchumacherFM\Pace\Model\System\Config\Source\ThemeFiles;

abstract class AbstractPace
{

    protected $_type = 'backend';

    /**
     * @var ConfigInterface
     */
    protected $_config;

    /**
     * @var \Magento\Framework\App\Cache\Proxy
     */
    protected $_cache;

    /**
     * @var \Magento\Framework\App\Cache\State
     */
    protected $_cacheState;

    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var ThemeFiles
     */
    protected $_themeFiles;

    /**
     * @param StoreManagerInterface $storeManager
     * @param Context $context
     * @param ConfigInterface $config
     * @param ThemeFiles $themeFiles
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        Context $context,
        ConfigInterface $config,
        ThemeFiles $themeFiles
    ) {
        $this->_storeManager = $storeManager;
        $this->_config = $config;
        $this->_cache = $context->getCache();
        $this->_cacheState = $context->getCacheState();
        $this->_themeFiles = $themeFiles;
    }

    /**
     * @param AbstractBlock $subject
     * @return bool
     */
    protected function _isAllowed(AbstractBlock $subject) {
        if ($subject instanceof RequireJs) {
            return true;
        }

        if ($this->_config->isFrontendEnabled()) {
            $this->_type = 'frontend';
            return true;
        }
        return false;
    }


    /**
     * gets css/js for pace.js and saves or loads it from cache
     *
     * @return string
     */
    protected function _getPaceHtml() {
        $pace = $this->_loadCache();
        if (false === $pace) {
            $pace = $this->_getCss() . $this->_getJs();
            $this->_saveCache($pace);
        }
        return $pace;
    }

    /**
     * @return string
     */
    protected function _getCss() {
        $color = $this->_config->getThemeColor();
        $color = true === empty($color) ? '' : $color . DIRECTORY_SEPARATOR;

        return '<style type="text/css">' .
        $this->_compressCss(
            $this->_themeFiles->getPaceCssContent([$color, $this->_config->getThemeFileName($this->_type)]) .
            $this->_config->getCustomCSS($this->_type)
        )
        . '</style>';
    }

    /**
     * @return string
     */
    protected function _getJs() {
        return '<script type="text/javascript">' .
        $this->_themeFiles->getPaceJsContent()
        . '</script>';
    }

    /**
     * @param $css
     *
     * @return string
     */
    protected function _compressCss($css) {
        $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
        $css = str_replace([': ', ', '], [':', ','], $css);
        return preg_replace('~([\r\n\t]+|\s{2,})~', '', $css);
    }

    /**
     * Load block html from cache storage
     *
     * @return string|false
     */
    protected function _loadCache() {
        if (!$this->_cacheState->isEnabled(\Magento\Framework\View\Element\AbstractBlock::CACHE_GROUP)) {
            return false;
        }
        return $this->_cache->load($this->getCacheKey());
    }

    /**
     * Save block content to cache storage
     *
     * @param string $data
     * @return $this
     */
    protected function _saveCache($data) {
        if (!$this->_cacheState->isEnabled(\Magento\Framework\View\Element\AbstractBlock::CACHE_GROUP)) {
            return false;
        }
        $cacheKey = $this->getCacheKey();
        $this->_cache->save($data, $cacheKey, $this->getCacheTags(), $this->getCacheLifetime());
        return $this;
    }

    protected function getCacheLifetime() {
        return null; // unlimited time valid
    }

    protected function getCacheTags() {
        return [
            \Magento\Backend\Block\Menu::CACHE_TAGS // are there any better?
        ];
    }

    protected function getCacheKey() {
        $key = [
            $this->_storeManager->getStore()->getId(),
            'pace_js',
            $this->_type,
            $this->_config->getThemeColor(),
            $this->_config->getThemeFileName(),
        ];
        return implode('_', $key);
    }
}
