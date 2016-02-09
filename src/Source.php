<?php

namespace vm\upload;

use yii\base\Component;

/**
 * Class Source
 * @package yii2vm\web\upload
 */
abstract class Source extends Component
{
    /**
     * @return mixed
     */
    abstract public function getContent();
}