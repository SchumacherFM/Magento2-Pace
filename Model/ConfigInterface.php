<?php
/**
 * @author kiri
 * @date 1/4/15
 */

namespace SchumacherFM\Pace\Model;

interface ConfigInterface
{
    /**
     * @param string $type
     *
     * @return string
     */
    public function getThemeFileName($type = 'backend');

    /**
     * @param string $type
     * @return string
     */
    public function getThemeColor($type = 'backend');

    /**
     * @param string $type
     *
     * @return string
     */
    public function getCustomCSS($type = 'backend');

    /**
     * @return bool
     */
    public function isFrontendEnabled();
}