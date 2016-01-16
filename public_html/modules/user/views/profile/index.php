<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Профиль';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <div class="row">
        <div class="col-md-12 text-center">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-5 col-md-2 text-center">
            <?= Html::a('Изменить', ['update'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    </br>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <?= DetailView::widget([
                'model'=>$model,
                'condensed'=>true,
                'hover'=>true,
                'panel'=>[
                    'heading'=>$model->username,
                    'headingOptions'=>[
                        'class'=>'text-center',
                        'template'=>'{title}',
                    ]
                ],
                'mode'=>DetailView::MODE_VIEW,
                'attributes'=>[
                    'username',
                    'email',
                    'name',
                    'surname',
                    'gender',
                    'age',
                    'role',
                ]
            ]);?>
        </div>
    </div>

</div>
