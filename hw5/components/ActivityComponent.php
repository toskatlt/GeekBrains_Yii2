<?php

namespace app\components;

use app\models\Activity;
use yii\base\Component;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class ActivityComponent extends Component
{
    public $classEntity;

    public function init()
    {
        parent::init();

        if (empty($this->classEntity)) {
            throw new \Exception('classEntity param required');
        }
    }

    public function getEntity()
    {
        return new $this->classEntity();
    }

    public function createActivity(Activity &$model): bool
    {
        $model->image = UploadedFile::getInstance($model, 'image');

        if ($model->validate()) {
            if($model->image){
                if($file=$this->saveUploadedFile($model->image)){
                    $model->image=$file;
                }
            }
            return true;
        }
        return false;
    }

    private function saveUploadedFile(UploadedFile $file): string
    {
        $path = $this->getPathToSaveImage();
        $filename = $this->genFileName($file);
        $path .= DIRECTORY_SEPARATOR . $filename;

        if ($file->saveAs($path)) {
            return $filename;
        } else {
            return null;
        }

    }

    private function getPathToSaveImage(): string
    {
        $path = \Yii::getAlias('@webroot/images');
        FileHelper::createDirectory($path);
        return $path;
    }

    private function genFileName(UploadedFile $file)
    {
        return time() . '_' . $file->getBaseName() . '.' . $file->getExtension();
    }
}