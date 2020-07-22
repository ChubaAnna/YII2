<?php

namespace backend\models;

use yii\base\Model;
// use yii\web\UploadedFile;

class CategoryForm extends Model
{
    public $name;
    public $description;

    public function rules()
    {
        return [
            [['name', 'description'], 'required', 'message' => 'значення обов\'язкове'],
            [['name', 'description'], 'string', 'message' => 'невірний тип'],
        ];
    }

    public function attributeLabels()
    {
        return [
        'name' => 'Назва акції',
        'description' => 'Опис акції',
        ];
    }
    public function upload(){
        if($this->validate('name', 'description')){
            // $this->imageFile->saveAs($this->imagePath());     
            return true; 
    }
    return false;
}
    // public function imagePath()
    // {
    //     return '../../uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
    // }
}
