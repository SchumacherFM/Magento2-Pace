<?php
/**
 * @category    SchumacherFM_Pace
 * @package     Model
 * @author      Cyrill at Schumacher dot fm / @SchumacherFM
 * @copyright   Copyright (c)
 * @license     The MIT License (MIT)
 */
namespace SchumacherFM\Pace\Block\Plugin\Backend\Page;


class RequireJs extends \SchumacherFM\Pace\Block\Plugin\AbstractPace
{

    /**
     *
     * @param \Magento\Backend\Block\Page\RequireJs $subject
     * @param string $html
     *
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterToHtml(\Magento\Backend\Block\Page\RequireJs $subject, $html)
    {
        /** @var $subject \Magento\Backend\Block\Page\RequireJs\Interceptor */
        return ($this->_isAllowed($subject) ? $this->_getPaceHtml() : '') . $html;
    }

}
