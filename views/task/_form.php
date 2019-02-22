<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textArea(['maxlength' => true, 'rows' => 3]) ?>

    <?= $form->field($model, 'estimated_points')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'attached_file')->fileInput() ?>

    <?= $form->field($model, 'assigned_to')->dropdownList($this->params['userList'], ['prompt'=>'']) ?>

    <?= $form->field($model, 'status_id')->dropdownList(
        [
            1 => 'Open',
            2 => 'In Progress',
            3 => 'Completed',
            4 => 'Archived'
        ], 
        [
            'prompt'=> ''
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['id' => 'createTask', 'class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
