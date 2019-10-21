<?php
/**
 * @category    SchumacherFM_Pace
 * @package     Model
 * @author      Cyrill at Schumacher dot fm / @SchumacherFM
 * @copyright   Copyright (c)
 * @license     The MIT License (MIT)
 */
namespace SchumacherFM\Pace\Block\Plugin\Frontend\Page;


class RequireJs extends \SchumacherFM\Pace\Block\Plugin\AbstractPace
{

    /**
     * There is also the possibility to add a block to head.additional but then
     * pace would be added a little bit later to the page instead of right after
     * the <head> tag.
     *
     * @param \SchumacherFM\Pace\Block\Page\RequireJs\Interceptor $subject
     * @param string $html
     *
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterToHtml(\SchumacherFM\Pace\Block\Page\RequireJs\Interceptor $subject, $html)
    {
        return ($this->_isAllowed($subject) ? $this->_getPaceHtml() : '') . PHP_EOL . $html;
    }
}
