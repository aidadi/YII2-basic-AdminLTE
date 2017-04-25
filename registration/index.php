<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

?>

<div class="text-center">
    <h1>Регистрация</h1>

    <?php if ($RegMessage) { ?>
        <?= $RegMessage ?>
    <?php } else { ?>

    <?php $form = ActiveForm::begin([
        'id' => 'registration-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n{input}<br />{error}",
            'labelOptions' => ['class' => ' control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->
            textInput(['autofocus' => true, 'placeholder' => 'name@email.com'])->
            label('E-mail') ?>

        <?= $form->field($model, 'password')->
        passwordInput()->label('Пароль') ?>

        <?= $form->field($model, 'repassword')->
        passwordInput()->label('Повторите пароль') ?>


       <?= Html::submitButton('Регистрация',
       ['class' => 'btn btn-success',
       'name' => 'registration-button']) ?>


    <?php ActiveForm::end(); ?>

    <?php } ?>

</div>
