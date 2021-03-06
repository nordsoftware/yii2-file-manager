<?php

namespace nord\yii\filemanager\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "file".
 *
 * @property integer $id
 * @property string $name
 * @property string $extension
 * @property string $folder
 * @property string $type
 * @property string $size
 * @property string $hash
 * @property string $storage
 * @property string $createdAt
 * @property integer $status
 */
class File extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'createdAt',
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'extension', 'type', 'storage'], 'required'],
            [['createdAt'], 'safe'],
            [['size', 'status'], 'integer', 'integerOnly' => true],
            [['name', 'extension', 'folder', 'type', 'hash', 'storage'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'extension' => 'Extension',
            'folder' => 'Folder',
            'type' => 'Type',
            'size' => 'Size',
            'hash' => 'Hash',
            'storage' => 'Storage',
            'createdAt' => 'Created At',
            'status' => 'Status',
        ];
    }


    /**
     * Returns the name of this file, without the file extension
     *
     * @return string
     */
    public function getBaseName()
    {
        return "{$this->name}-{$this->id}";
    }

    /**
     * Returns the file name for this file.
     *
     * @return string file name
     */
    public function getFileName()
    {
        return "{$this->name}-{$this->id}.{$this->extension}";
    }

    /**
     * Returns the file path for this file.
     *
     * @return string file path.
     */
    public function getFilePath()
    {
        $fileName = $this->getFileName();
        return $this->folder !== null ? "{$this->folder}/{$fileName}" : $fileName;
    }
}
