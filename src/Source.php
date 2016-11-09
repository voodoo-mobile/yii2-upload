<?php

namespace vr\upload;

use yii\base\Component;

/**
 * Class Source
 * @package yii2vr\web\upload
 */
abstract class Source extends Component
{
    /**
     * @return mixed
     */
    abstract public function getContent();
}