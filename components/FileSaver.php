<?php


namespace app\components;


use app\models\Activity;
use yii\base\Component;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class FileSaver extends Component
{
  public $fileClass;

  public function init()
  {
    parent::init();
  }

  public function saveFile(UploadedFile $file): ?string{
    $name=$this->genFileName($file);
    $path=$this->getPathToSave().$name;
    if ($file->saveAs($path)){
      return $name;
    }
    return null;
  }

  private function getPathToSave(){
    $path = \Yii::getAlias('@webroot/files/');
    FileHelper::createDirectory($path);
    return $path;
  }

  private function genFileName(UploadedFile $file){
    return time().$file->getBaseName().'.'.$file->getExtension();
  }

}