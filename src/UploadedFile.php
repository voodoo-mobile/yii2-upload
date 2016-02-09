<?php

namespace vm\upload;

use yii\base\Component;

/**
 * Class UploadedFile
 * @package yii2vm\web
 *
 *          Handles uploaded files. In opposite to the default uploaded file it provides few ways to load a file from
 *          different sources and allows saving with few different writers like file and s3.
 *          How to use
 *
 *          (new UploadedFile([
 *              'source' => new Base64Source([
 *                  'base64' => 'AABBCC.....'
 *              ])
 *          ]))->save((new FileWriter())->useActiveRecord($model, 'image'));
 *
 */
class UploadedFile extends Component
{
    /**
     * @var Writer Writer that is used for saving file
     */
    public $writer;

    /**
     * @var Source Source of the content
     */
    public $source;

    /**
     * Creates an instance of the class using source. Few sources are available: base64, named file instance for models, file
     * by uri
     *
     * @param Source $source
     *
     * @return $this
     */
    public static function instance($source)
    {
        return \Yii::createObject([
            'class'  => self::className(),
            'source' => $source
        ]);
    }

    /**
     * Saves the file using writer. Review [[Writer]] to find out what is available
     *
     * @param Writer $writer
     *
     * @return string The file path or another identifier of the uploaded file
     */
    public function save($writer)
    {
        return $writer->save($this->source->getContent());
    }
}