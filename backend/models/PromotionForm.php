<?php

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class PromotionForm extends Model
{
    public $name;
    public $description;
    public $imageFile;

    public function rules()
    {
        return [
            [['name', 'description'], 'required', 'message' => 'значення обов\'язкове'],
            [['name', 'description'], 'string', 'message' => 'невірний тип'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'message' => 'необхідно завантажити файл або невірний формат файлу'],
        ];
    }

    public function attributeLabels()
    {
        return [
        'name' => 'Назва акції',
        'description' => 'Опис акції',
        'imageFile' => 'Картинка акції',
        ];
    }
    public function upload(){
        if($this->validate('name', 'description')){
            $this->imageFile->saveAs($this->imagePath());     
            return true; 
    }
    return false;
}
    public function imagePath()
    {
        return '../../uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
    }
}
