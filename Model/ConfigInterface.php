<?php
/**
 * @author kiri
 * @date 1/4/15
 */

namespace SchumacherFM\Pace\Model;

interface ConfigInterface
{
    /**
     * Get Theme file config
     *
     * @param string $type
     * @return string
     */
    public function getThemeFileName($type = 'backend');

    /**
     * Get Theme color config
     *
     * @param string $type
     * @return string
     */
    public function getThemeColor($type = 'backend');

    /**
     * Get Custom CSS config
     *
     * @param string $type
     * @return string
     */
    public function getCustomCSS($type = 'backend');

    /**
     * Get is frontend enabled config
     *
     * @return bool
     */
    public function isFrontendEnabled();
}
