<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php if(isset($this->params['userList'])): ?>
        <?php $form = ActiveForm::begin(['action' => ['task/save'],'method' => 'post']); ?>
    <?php else: ?>
        <?php $form = ActiveForm::begin(['action' => Url::to('index.php?r=task%2Fupdate&id='.Yii::$app->getRequest()->getQueryParam('id')),'method' => 'post']); ?>
    <?php endif; ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textArea(['maxlength' => true, 'rows' => 3]) ?>

    <?= $form->field($model, 'estimated_points')->textInput(['type' => 'number']) ?>

    <?php // echo $form->field($model, 'attached_file')->fileInput() ?>

    <?php if(isset($this->params['userList'])): ?>
        <?= $form->field($model, 'assigned_to')->dropdownList($this->params['userList'], ['prompt'=>'']) ?>
    <?php else: ?>
        <?= $form->field($model, 'assigned_to')->dropdownList($this->params['users'], ['prompt'=>'']) ?>
    <?php endif; ?>
    
    <?= $form->field($model, 'status_id')->dropdownList(
        [
            1 => 'Open',
            2 => 'In Progress',
            3 => 'Completed',
            4 => 'Archived'
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['id' => 'saveTask', 'class' => 'btn btn-success btn-round']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
