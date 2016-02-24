<?php
namespace vm\upload;

class UriSource extends Source
{
    public $uri;

    /**
     * @param $uri
     *
     * @return mixed
     */
    public static function create($uri)
    {
        return \Yii::createObject([
            'class'     => self::className(),
            'uri'     => $uri
        ]);
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return file_get_contents($this->uri);
    }
}