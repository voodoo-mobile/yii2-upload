<?php

namespace vm\upload;

use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;

/**
 * Class FileWriter
 * @package yii2vm\web\upload
 */
class FileWriter extends Writer
{
    /**
     * @var string
     */
    public $target = 'uploads';

    /**
     * @var null
     */
    public $extension = null;

    /**
     * @var bool
     */
    public $useFullPath = false;

    /**
     * @param $content
     *
     * @return mixed
     */
    public function save($content)
    {
        $path = $this->buildPath();

        $this->createDir($path);
        file_put_contents($path, $content);

        $this->getExtension($path);

        if ($this->extension) {
            rename($path, $path . '.' . $this->extension);
            $path .= '.' . $this->extension;
        }

        return $path;
    }

    /**
     * @param $filename
     *
     * @throws \yii\base\InvalidConfigException
     */
    private function getExtension($filename)
    {
        if (!$this->extension) {
            $mime       = FileHelper::getMimeType($filename);
            $extensions = FileHelper::getExtensionsByMimeType($mime);
            if (count($extensions) > 0) {
                $this->extension = ArrayHelper::getValue($extensions, count($extensions) - 1);
            }
        }
    }

    private function createDir($path)
    {
        $directory = pathinfo($path, PATHINFO_DIRNAME);
        if (!file_exists($directory)) {
            mkdir($directory);
        }
    }


    private function buildPath()
    {
        $path = $this->target . '/' . $this->filename;

        if ($this->useFullPath) {
            $path = \Yii::getAlias('@webroot/') . $path;
        }

        return $path;
    }
}