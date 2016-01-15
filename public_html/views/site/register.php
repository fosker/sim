<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Register */
/* @var $form ActiveForm */
?>
<div class="container">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'password') ?>
    <?= $form->field($model, '_password') ?>
    <?php if (Yii::$app->request->get('role') == 'designer') {
        $model->role = 2;
    } else {
        $model->role = 1;
    }?>
    <?= $form->field($model, 'role')->radioList(array(1 => 'Клиент', 2 => 'Дизайнер'),
        array('labelOptions'=>array('style'=>'display:inline'), 'separator'=>'&nbsp;&nbsp;&nbsp;</br>',)); ?>

    <div class="form-group">
        <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
