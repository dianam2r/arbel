<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class='edit-tools'>
        <div class="edit-option">
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-round']) ?>
        </div>
        <div class="edit-option">
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-round',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        <div class="edit-option">
            <?= Html::button('List tasks', ['id' => 'listTask', 'value' => Url::to(['task/list']), 'class' => 'btn btn-info btn-list-task']) ?>
        </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description',
            'estimated_points',
            //'attached_file',
            'assigned_to',
            'status_id',
            'created_at',
            //'updated_at',
            'created_by',
            //'updated_by',
        ],
    ]) ?>

</div>
