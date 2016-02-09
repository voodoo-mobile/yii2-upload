<?php
namespace yii2vm\web\upload;

/**
 * Class Base64Source
 * @package yii2vm\web\upload
 */
class Base64Source extends Source
{
    /**
     * @var
     */
    public $base64;

    /**
     * @param $base64
     *
     * @return $this
     * @throws \yii\base\InvalidConfigException
     */
    public static function create($base64)
    {
        return \Yii::createObject([
            'class'  => self::className(),
            'base64' => $base64
        ]);
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return base64_decode($this->base64);
    }
}