<?php

/**
 * @category    SchumacherFM_Pace
 * @package     Model
 * @author      Cyrill at Schumacher dot fm / @SchumacherFM
 * @copyright   Copyright (c)
 * @license     The MIT License (MIT)
 */

namespace SchumacherFM\Pace\Model\System\Config\Source;

class ThemeColors extends AbstractTheme
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {

        $colors = ['black', 'blue', 'green', 'orange', 'pink', 'purple', 'red', 'silver', 'white', 'yellow'];
        $return = [
            ['value' => '', 'label' => __('Default')]
        ];
        foreach ($colors as $color) {
            $return[] = ['value' => $color, 'label' => __($color)];
        }
        return $return;
    }
}
