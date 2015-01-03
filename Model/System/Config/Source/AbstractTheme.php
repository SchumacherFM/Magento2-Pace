<?php

/**
 * @category    SchumacherFM_Pace
 * @package     Model
 * @author      Cyrill at Schumacher dot fm / @SchumacherFM
 * @copyright   Copyright (c)
 * @license     The MIT License (MIT)
 */
namespace SchumacherFM\Pace\Model\System\Config\Source;

abstract class AbstractTheme implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        $return = [];
        foreach ($this->toOptionArray() as $o) {
            $return[$o['value']] = $o['label'];
        }
        return $return;
    }
}
