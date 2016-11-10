<?php

namespace vr\upload;

/**
 * Class FileWriter
 * @package yii2vr\web\upload
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

        if (!$this->extension) {
            $this->extension = $this->determineExtension($content);
        }

        if ($this->extension) {
            rename($path, $path . '.' . $this->extension);
            $path .= '.' . $this->extension;
        }

        return $path;
    }

    private function buildPath()
    {
        $path = $this->target . '/' . $this->filename;

        if ($this->useFullPath) {
            $path = \Yii::getAlias('@webroot/') . $path;
        }

        return $path;
    }

    private function createDir($path)
    {
        $directory = pathinfo($path, PATHINFO_DIRNAME);
        if (!file_exists($directory)) {
            mkdir($directory);
        }
    }
}