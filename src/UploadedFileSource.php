<?php
namespace vr\upload;

use yii\web\UploadedFile;

class UploadedFileSource extends Source
{
    /**
     * @var UploadedFile
     */
    public $instance;

    /**
     * @param $instance
     *
     * @return $this
     * @throws \yii\base\InvalidConfigException
     */
    public static function create($instance)
    {
        return \Yii::createObject([
            'class'  => self::className(),
            'instance' => $instance
        ]);
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return file_get_contents($this->instance->tempName);
    }
}