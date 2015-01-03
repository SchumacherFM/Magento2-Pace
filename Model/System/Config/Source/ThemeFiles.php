<?php

/**
 * @category    SchumacherFM_Pace
 * @package     Model
 * @author      Cyrill at Schumacher dot fm / @SchumacherFM
 * @copyright   Copyright (c)
 * @license     The MIT License (MIT)
 */
namespace SchumacherFM\Pace\Model\System\Config\Source;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;

class ThemeFiles extends AbstractTheme
{
    /**
     * @var \Magento\Framework\Filesystem\Directory\ReadInterface
     */
    protected $_modulesDirectory;

    /**
     * @param Filesystem $filesystem
     */
    public function __construct(
        \Magento\Framework\Filesystem $filesystem
    )
    {
        $this->_modulesDirectory = $filesystem->getDirectoryRead(DirectoryList::MODULES);
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {

        $files = $this->_modulesDirectory->read(
            implode(DIRECTORY_SEPARATOR, ['SchumacherFM', 'Pace', 'view', 'adminhtml', 'web', 'js', 'pace', 'themes'])
        );

        $return = [];

        foreach ($files as $file) {
            $bFile = basename($file);
            $return[] = ['value' => $bFile, 'label' => $bFile];
        }

        return $return;
    }
}
