<?php

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class ClientForm extends Model
{
    public $name;
    public $lastname;
    public $secondname;
    public $email;
    public $phone;
    
    public function rules()
    {
        return [
            [['name', 'lastname', 'secondname', 'email', 'phone'], 'string', 'message' => 'невірний тип'],
            [['name', 'lastname', 'secondname', 'email', 'phone'], 'required', 'message' => 'значення обов\'язкове'],
            
        ];
    }

    public function attributeLabels()
    {
        return [
        'lastname' => 'Прізвище покупця',
        'name' => 'Імя покупця',
        'secondname' => 'По-батькові покупця',
        'email' => 'Почта покупця',
        'phone' => 'Телефон покупця',
        ];
    }
   
}
