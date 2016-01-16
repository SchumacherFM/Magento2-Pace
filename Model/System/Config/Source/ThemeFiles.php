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
     * @var ComponentRegistrar
     */
    private $componentRegistrar;

    /**
     * @var ReadFactory
     */
    private $readDirFactory;

    /**
     * Constructor
     *
     * @param ComponentRegistrar $componentRegistrar
     * @param ReadFactory $readDirFactory
     */
    public function __construct(
        ComponentRegistrar $componentRegistrar,
        ReadFactory $readDirFactory
    )
    {
        $this->componentRegistrar = $componentRegistrar;
        $this->readDirFactory = $readDirFactory;
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
        $cssDir = $this->getBaseDir() . 'themes' . DIRECTORY_SEPARATOR;
        $readDir = $this->readDirFactory->create($cssDir);
        return $readDir->search('pace*.css');
    }

    /**
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
     * @param array $path
     * @return string
     */
    public function getPaceCssContent(array $path)
    {
        $filePath = $this->getBaseDir() . 'themes'  . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $path);
        $themeDir = dirname( $filePath );
        $themeFile = basename( $filePath );
        $dir = $this->readDirFactory->create($themeDir);
        return $dir->readFile($themeFile);
    }
}
