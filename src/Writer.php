<?php

namespace vr\upload;

use yii\base\Component;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\Inflector;

/**
 * Class Writer
 * @package yii2vr\web\upload
 */
abstract class Writer extends Component
{

    /**
     * @var null
     */
    public $filename = null;

    /**
     * @param $activeRecord
     *
     * @param $attribute
     *
     * @return $this
     */
    public function useActiveRecord($activeRecord, $attribute)
    {
        $this->filename = $this->getFilenameFor($activeRecord, $attribute);

        return $this;
    }

    /**
     * @param  ActiveRecord $activeRecord
     * @param               $attribute
     * @param null $extension
     *
     * @return string
     */
    public function getFilenameFor($activeRecord, $attribute, $extension = null)
    {
        $path = Inflector::camel2id((new \ReflectionClass($activeRecord))->getShortName());
        $basename = implode('-', $activeRecord->getPrimaryKey(true)) . '-' . $attribute;

        if ($extension) {
            $basename .= '.' . $extension;
        }

        return $path . DIRECTORY_SEPARATOR . $basename;
    }

    /**
     * @param $content
     *
     * @return mixed
     */
    abstract public function save($content);

    /**
     * @param $content
     *
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     */
    protected function determineExtension($content)
    {
        $filename = \Yii::getAlias('@runtime/' . uniqid());
        file_put_contents($filename, $content);

        $mime = FileHelper::getMimeType($filename);

        $extensions = FileHelper::getExtensionsByMimeType($mime);

        unlink($filename);

        return ArrayHelper::getValue($extensions, max(count($extensions) - 1, 0));
    }
}