<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="row">
    <div class="col-md-12">
        <h3>ДОДАТИ КАТЕГОРІЮ</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
    <?php
        $form = ActiveForm::Begin(
            [
                // 'method' => 'post',
                'options' => [
                    'enctype' => 'multipart/form-data'
                ]
            ]
        );
            echo $form->field($model, 'name')->textInput();
            echo $form->field($model, 'description')->textarea(['row' => '5']);
    ?>
    <div class="form-group">
    <?= Html::submitButton('ЗБЕРІГТИ', ['class => btn btn-primary pull-left']) ?>
    </div>
    <?php
        ActiveForm::end();
    ?>
    </div>
</div>
