<?php
namespace vr\upload;

/**
 * Class Base64Source
 * @package yii2vr\web\upload
 */
class Base64Source extends Source
{
    const STOPPER = 'base64,';
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
        if (($pos = strpos($base64, self::STOPPER)) !== false) {
            $base64 = substr($base64, $pos + strlen(self::STOPPER));
        }

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