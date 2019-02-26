<?php

/* @var $this yii\web\View */
// defined('YII_ENV') or define('YII_ENV', 'dev');

use yii\helpers\Html;
use yii\helpers\Url;

// If user is not logged in it should redirect to login page
if(Yii::$app->user->getIsGuest()){
    Yii::$app->response->redirect(['site/login']);
}

$this->title = 'Arbel';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>General Dashboard</h1>
        <p class="lead">You can have a broad view of your tasks here</p>
        <p>
            <?= Html::button('Add a task', ['id' => 'createTask', 'value' => Url::to(['task/create']), 'class' => 'btn btn-warning btn-task']) ?>
            <?= Html::button('List tasks', ['id' => 'listTask', 'value' => Url::to(['task/list']), 'class' => 'btn btn-info btn-list-task']) ?>
        </p>
    </div>

    <?= $this->render('../layouts/modal') ?>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <h2 class="tb-space">Open</h2>

                <?php foreach($records as $tasks): ?>
                    <?php foreach($tasks as $task): ?>
                        <?php if($task['status_id'] == 1): ?>
                            <div class="task-tools">
                                <a href="<?= Url::to('index.php?r=task%2Fview&id='.$task['id']) ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <a href="<?= Url::to('index.php?r=task%2Fupdate&id='.$task['id']) ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="<?= Url::to('index.php?r=task%2Fdelete&id='.$task['id']) ?>" data-method="POST" data-confirm="You are about to delete a task, do you want to proceed?"><span class="glyphicon glyphicon-trash"></span></a>
                            </div>

                            <div class="task-wrapper">
                                <span class="task-title"><?= $task['title'] ?></span>
                                <span class="task-description"><?= $task['description'] ?></span>
                                <span>Estimated points: <?= $task['estimated_points']?></span>
                                <span>Assigned to: <?= $task['assigned_to'] ?></span>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>                
                <?php endforeach; ?>
            </div>

            <div class="col-lg-4">
                <h2 class="tb-space">In Progress</h2>

                <?php foreach($records as $tasks): ?>
                    <?php foreach($tasks as $task): ?>
                        <?php if($task['status_id'] == 2): ?>
                            <div class="task-tools">
                                <a href="<?= Url::to('index.php?r=task%2Fview&id='.$task['id']) ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <a href="<?= Url::to('index.php?r=task%2Fupdate&id='.$task['id']) ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="<?= Url::to('index.php?r=task%2Fdelete&id='.$task['id']) ?>" data-method="POST" data-confirm="You are about to delete a task, do you want to proceed?"><span class="glyphicon glyphicon-trash"></span></a>
                            </div>

                            <div class="task-wrapper">
                                <span class="task-title"><?= $task['title'] ?></span>
                                <span class="task-description"><?= $task['description'] ?></span>
                                <span>Estimated points: <?= $task['estimated_points']?></span>
                                <span>Assigned to: <?= $task['assigned_to'] ?></span>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>                
                <?php endforeach; ?>
            </div>

            <div class="col-lg-4">
                <h2 class="tb-space">Completed</h2>

                <?php foreach($records as $tasks): ?>
                    <?php foreach($tasks as $task): ?>
                        <?php if($task['status_id'] == 3): ?>
                            <div class="task-tools">
                                <a href="<?= Url::to('index.php?r=task%2Fview&id='.$task['id']) ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <a href="<?= Url::to('index.php?r=task%2Fupdate&id='.$task['id']) ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="<?= Url::to('index.php?r=task%2Fdelete&id='.$task['id']) ?>" data-method="POST" data-confirm="You are about to delete a task, do you want to proceed?"><span class="glyphicon glyphicon-trash"></span></a>
                            </div>

                            <div class="task-wrapper">
                                <span class="task-title"><?= $task['title'] ?></span>
                                <span class="task-description"><?= $task['description'] ?></span>
                                <span>Estimated points: <?= $task['estimated_points']?></span>
                                <span>Assigned to: <?= $task['assigned_to'] ?></span>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>                
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    </div>
</div>
