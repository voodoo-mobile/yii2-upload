<?php

namespace vr\upload;

use yii\web\UploadedFile;

/**
 * Class ModelSource
 * @package yii2vr\web\upload
 */
class ModelSource extends Source
{
    /**
     * @var
     */
    public $model;

    /**
     * @var
     */
    public $attribute;

    /**
     * @param $model
     * @param $attribute
     *
     * @return $this
     * @throws \yii\base\InvalidConfigException
     */
    public static function create($model, $attribute)
    {
        return \Yii::createObject([
            'class'     => self::className(),
            'model'     => $model,
            'attribute' => $attribute,
        ]);
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return file_get_contents(UploadedFile::getInstance($this->model, $this->attribute)->tempName);
    }
}