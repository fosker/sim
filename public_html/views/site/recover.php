<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;



$this->title = 'Восстановление пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $sendForm = ActiveForm::begin([
        'id' => 'send-email-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

    <?php $recoverForm = ActiveForm::begin([
        'id' => 'recover-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

    <?php ActiveForm::end(); ?>


    <?php

    $classButton = 'hidden';

    $wizard_config = [
        'id' => 'stepwizard',
        'steps' => [
            1 => [
                'title' => 'Шаг 1',
                'icon' => Yii::$app->session['sendRecoverEmail'] ? 'glyphicon glyphicon-ok' : 'glyphicon glyphicon-send',
                'content' =>
                    ' <div class="container">
                         <form id="send-email-form" class="form-horizontal" action="/web/site/recover" method="post">
                        <input type="hidden" name="_csrf" value="Qmprcm02aUN1OiQaNVhaETgNAl8ZVCcyIBNTRBlmBysOJi0jH0BbEg==">
                        <div class="form-group field-recover-email required">
                            '.
                            $sendForm->field($sendModel, 'email')
                            .'
                            <div class="col-lg-8">
                                <p class="help-block help-block-error"></p>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary center-text col-md-2" name="send-email-button">Отправить письмо</button>
                        </form>
                        </div>',
            ],
            2 => [
                'title' => 'Шаг 2',
                'icon' => $isRecovered ? 'glyphicon glyphicon-ok' : 'glyphicon glyphicon-refresh',
                'content' => '
                                <div class="container">
                                <form id="recover-form" class="form-horizontal" action="/web/site/recover" method="post">
                                <input type="hidden" name="_csrf" value="N1RsWTNjd0kABCMxaw1EG00zBXRHATk4VS1Ub0czGSF7GCoIQRVFGA==">
                                    <div class="form-group field-recover-newpassword required">'.
                                $recoverForm->field($recoverModel, 'newPassword')
                                .'
                                <div class="col-lg-8"><p class="help-block help-block-error"></p></div>
                                </div>    <div class="form-group field-recover-_password required">'.
                                $recoverForm->field($recoverModel, '_password')
                                .'
                                <div class="col-lg-8"><p class="help-block help-block-error"></p></div>
                                </div>    <div class="form-group field-recover-secret_key required">'.
                               $recoverForm->field($recoverModel, 'secret_key')
                                .'
                                <div class="col-lg-8"><p class="help-block help-block-error"></p></div>
                                </div>
                                <button type="submit" class="btn btn-primary center-text col-md-2" name="recover-button">Изменить пароль</button>
                               </form>

                                <form id="recover-form" class="form-horizontal" action="/web/site/recover" method="post">
                                <input type="hidden" name="_csrf" value="Qmprcm02aUN1OiQaNVhaETgNAl8ZVCcyIBNTRBlmBysOJi0jH0BbEg==">


                               <input type="hidden" id="sendemail-email" value="'.Yii::$app->session['recoverEmail'].'"
                               class="form-control" name="SendEmail[email]">
                               <button type="submit" class="btn btn-primary center-text col-md-2 col-md-offset-1" name="send-email-button">Отправить ещё раз</button>
                               </form>
                               </div>',
            ],
        ],
        'start_step' => Yii::$app->session['sendRecoverEmail'] ? 2 : 1,
    ];
    ?>
    <?php ActiveForm::end(); ?>
    <?= \drsdre\wizardwidget\WizardWidget::widget($wizard_config); ?>





</div>
