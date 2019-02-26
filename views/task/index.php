<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="edit-tools">
        <div class="edit-option">
            <?= Html::button('Create Task', ['id' => 'createTask', 'value' => Url::to(['task/create']), 'class' => 'btn btn-primary btn-create-task']) ?>
            <?= $this->render('../layouts/modal') ?>
        </div>
        <div class="edit-option">
            <?= Html::button('Search Task', ['id' => 'searchTask', 'value' => Url::to(['search']), 'class' => 'btn btn-secondary btn-round']) ?>
            <?= $this->render('../layouts/searchModal') ?>
        </div>
    </div>

    <?php if(isset($this->params['resultData'])): ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'title',
                'description',
                'estimated_points',
                //'attached_file',
                'assigned_to',
                'task_status',
                //'created_at',
                //'updated_at',
                //'created_by',
                //'updated_by',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    <?php else: ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'value' => function($data) {
                        return $data;
                    },
                ]
            ],
        ]); ?>
    <?php endif; ?>
</div>
