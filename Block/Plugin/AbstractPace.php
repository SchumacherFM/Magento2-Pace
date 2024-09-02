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
use \Magento\Framework\View\Element\Template\Context;
use \SchumacherFM\Pace\Model\ConfigInterface;
use \SchumacherFM\Pace\Model\System\Config\Source\ThemeFiles;

abstract class AbstractPace
{
    /**
     * @var type
     */
    protected $_type = 'backend';

    /**
     * Constructer function
     *
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param Context $context
     * @param ConfigInterface $config
     * @param ThemeFiles $themeFiles
     */
    public function __construct(
        protected \Magento\Store\Model\StoreManagerInterface $storeManager,
        protected Context $context,
        protected ConfigInterface $config,
        protected ThemeFiles $themeFiles
    ) {
    }

    /**
     * Is allowed method
     *
     * @param AbstractBlock $subject
     * @return bool
     */
    protected function _isAllowed(AbstractBlock $subject)
    {
        if ($subject instanceof RequireJs) {
            return true;
        }

        if ($this->config->isFrontendEnabled()) {
            $this->_type = 'frontend';
            return true;
        }
        return false;
    }

    /**
     * Gets css/js for pace.js and saves or loads it from cache
     *
     * @return string
     */
    protected function _getPaceHtml()
    {
        $pace = $this->_loadCache();
        if (false === $pace) {
            $pace = $this->_getCss() . $this->_getJs();
            $this->_saveCache($pace);
        }
        return $pace;
    }

    /**
     * Get CSS
     *
     * @return string
     */
    protected function _getCss()
    {
        $color = $this->config->getThemeColor();
        $color = true === empty($color) ? '' : $color . DIRECTORY_SEPARATOR;

        return '<style type="text/css">' .
        $this->_compressCss(
            $this->themeFiles->getPaceCssContent([$color, $this->config->getThemeFileName($this->_type)]) .
            $this->config->getCustomCSS($this->_type)
        )
        . '</style>';
    }

    /**
     * Get JS
     *
     * @return string
     */
    protected function _getJs()
    {
        return '<script type="text/javascript">' .
        $this->themeFiles->getPaceJsContent()
        . '</script>';
    }

    /**
     * Compress CSS
     *
     * @param string $css
     * @return string
     */
    protected function _compressCss($css)
    {
        $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
        $css = str_replace([': ', ', '], [':', ','], $css);
        return preg_replace('~([\r\n\t]+|\s{2,})~', '', $css);
    }

    /**
     * Load block html from cache storage
     *
     * @return string|false
     */
    protected function _loadCache()
    {
        if (!$this->context->getCacheState()->isEnabled(\Magento\Framework\View\Element\AbstractBlock::CACHE_GROUP)) {
            return false;
        }
        return $this->context->getCache()->load($this->getCacheKey());
    }

    /**
     * Save block content to cache storage
     *
     * @param string $data
     * @return $this
     */
    protected function _saveCache($data)
    {
        if (!$this->context->getCacheState()->isEnabled(\Magento\Framework\View\Element\AbstractBlock::CACHE_GROUP)) {
            return false;
        }
        $cacheKey = $this->getCacheKey();
        $this->context->getCache()->save($data, $cacheKey, $this->getCacheTags(), $this->getCacheLifetime());
        return $this;
    }

    /**
     * Get cache lifetime
     *
     * @return string|false
     */
    protected function getCacheLifetime()
    {
        return null; // unlimited time valid
    }

    /**
     * Get cache tags
     *
     * @return string|false
     */
    protected function getCacheTags()
    {
        return [
            \Magento\Backend\Block\Menu::CACHE_TAGS // are there any better?
        ];
    }

    /**
     * Get cache key
     *
     * @return string|false
     */
    protected function getCacheKey()
    {
        $key = [
            $this->storeManager->getStore()->getId(),
            'pace_js',
            $this->_type,
            $this->config->getThemeColor(),
            $this->config->getThemeFileName(),
        ];
        return implode('_', $key);
    }
}
