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
        $return = [];
        foreach ($this->getThemeFiles() as $file) {
            $bFile = basename($file);
            if (false !== strpos($file, '.css')) {
                $return[] = ['value' => $bFile, 'label' => $bFile];
            }
        }

        return $return;
    }

    /**
     * @return array
     */
    public function getThemeFiles()
    {
        return $this->_modulesDirectory->read($this->getBaseDir() . 'themes');
    }

    /**
     * @return string
     */
    public function getBaseDir()
    {
        return implode(DIRECTORY_SEPARATOR, ['SchumacherFM', 'Pace', 'view', 'adminhtml', 'web', 'js', 'pace']) .
        DIRECTORY_SEPARATOR;
    }

    /**
     * This is normally the incorrect place in this class to retrieve JS...
     *
     * @return string
     */
    public function getPaceJsContent()
    {
        return $this->_modulesDirectory->readFile($this->getBaseDir() . 'pace.min.js');
    }

    /**
     * @param array $path
     * @return string
     */
    public function getPaceCssContent(array $path)
    {
        return $this->_modulesDirectory->readFile($this->getBaseDir() . 'themes' .
            DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $path));
    }
}
