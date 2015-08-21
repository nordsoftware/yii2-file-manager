use nord\yii\filemanager\storages\S3Storage;

    /**
     * @var string the default storage to use when saving files
     */
    public $defaultStorage = self::DEFAULT_STORAGE;

                's3'   => ['class' => S3Storage::className()],
            'storage' => ArrayHelper::remove($storageConfig, 'name', $this->defaultStorage),
        if (!$this->getStorage($model->storage)->saveFile($model, $resource->getContents())) {
        if (!$this->getStorage($model->storage)->deleteFile($model)) {
        return $this->getStorage($model->storage)->getFileUrl($model);
        return $this->getStorage($model->storage)->getFilePath($model);
}