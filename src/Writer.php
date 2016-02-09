<?php
namespace yii2vm\web\upload;

use yii\base\Component;
use yii\db\ActiveRecord;
use yii\helpers\Inflector;

/**
 * Class Writer
 * @package yii2vm\web\upload
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
     * @param $content
     *
     * @return mixed
     */
    abstract public function save($content);

    /**
     * @param  ActiveRecord $activeRecord
     * @param               $attribute
     * @param null          $extension
     *
     * @return string
     */
    public function getFilenameFor($activeRecord, $attribute, $extension = null)
    {
        $path     = Inflector::camel2id((new \ReflectionClass($activeRecord))->getShortName());
        $basename = implode('-', $activeRecord->getPrimaryKey(true)) . '-' . $attribute;

        if ($extension) {
            $basename .= '.' . $extension;
        }

        return $path . DIRECTORY_SEPARATOR . $basename;
    }
}