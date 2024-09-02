<?php

/**
 * @category    SchumacherFM_Pace
 * @package     Model
 * @author      Cyrill at Schumacher dot fm / @SchumacherFM
 * @copyright   Copyright (c)
 * @license     The MIT License (MIT)
 */
namespace SchumacherFM\Pace\Model\System\Config\Source;

use Magento\Framework\Filesystem;
use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Filesystem\Directory\ReadFactory;

class ThemeFiles extends AbstractTheme
{
    /**
     * Constructor
     *
     * @param ComponentRegistrar $componentRegistrar
     * @param ReadFactory $readDirFactory
     * @param \Magento\Framework\Filesystem\Io\File $fileSystemIo
     */
    public function __construct(
        private ComponentRegistrar $componentRegistrar,
        private ReadFactory $readDirFactory,
        private \Magento\Framework\Filesystem\Io\File $fileSystemIo
    ) {
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
            $fileInfo = $this->fileSystemIo->getPathInfo($file);
            $bFile = $fileInfo['basename'];
            if (false !== strpos($file, '.css')) {
                $return[] = ['value' => $bFile, 'label' => $bFile];
            }
        }
        return $return;
    }

    /**
     * Get theme files
     *
     * @return array
     */
    public function getThemeFiles()
    {
        $cssDir = $this->getBaseDir() . 'themes' . DIRECTORY_SEPARATOR;
        $readDir = $this->readDirFactory->create($cssDir);
        return $readDir->search('pace*.css');
    }

    /**
     * Get Base Directory
     *
     * @return string
     */
    private function getBaseDir()
    {
        $path = $this->componentRegistrar->getPath(ComponentRegistrar::MODULE, 'SchumacherFM_Pace');
        return implode(DIRECTORY_SEPARATOR, [$path, 'view', 'adminhtml', 'web', 'js', 'pace']) . DIRECTORY_SEPARATOR;
    }

    /**
     * This is normally the incorrect place in this class to retrieve JS...
     *
     * @return string
     */
    public function getPaceJsContent()
    {
        $dir = $this->readDirFactory->create($this->getBaseDir());
        return $dir->readFile('pace.min.js');
    }

    /**
     * Get Pace css content
     *
     * @param array $path
     * @return string
     */
    public function getPaceCssContent(array $path)
    {
        $filePath = $this->getBaseDir() . 'themes'  . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $path);
        $fileInfo = $this->fileSystemIo->getPathInfo($filePath);
        $themeDir = $fileInfo['dirname'];
        $themeFile = $fileInfo['basename'];
        $dir = $this->readDirFactory->create($themeDir);
        return $dir->readFile($themeFile);
    }
}
