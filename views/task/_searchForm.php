<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin([
        'action' => ['list'],
        'method' => 'get',
    ]); ?>

    <?php // echo $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'estimated_points')->textInput(['type' => 'number', 'min' => "0"]) ?>

    <?php // echo $form->field($model, 'attached_file') ?>

    <?= $form->field($model, 'assigned_to') ?>

    <?= $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-round']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default btn-round']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
