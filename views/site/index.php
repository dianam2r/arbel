<?php

/* @var $this yii\web\View */
defined('YII_ENV') or define('YII_ENV', 'dev');

use yii\helpers\Html;
use yii\helpers\Url;

// If user is not logged in it should redirect to login page
if(Yii::$app->user->getIsGuest()){
    Yii::$app->response->redirect(['site/login']);
}

$this->title = 'Arbel';
?>
<div class="site-index">

    <!--<div class="jumbotron">
        <h1>Dashboard</h1>

        <p class="lead">Welcome! You can manage your tasks from here</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>-->

    <!--<div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>-->
    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <h2>Tasks</h2>
                
                <?= Html::button('Add a task', ['id' => 'createTask', 'value' => Url::to(['task/create']), 'class' => 'btn btn-warning btn-task']) ?>
                <?= Html::button('List tasks', ['id' => 'listTask', 'value' => Url::to(['task/list']), 'class' => 'btn btn-info btn-list-task']) ?>
                
                <?= $this->render('../layouts/modal') ?>

                <?php foreach($records as $tasks): ?>
                    <?php foreach($tasks as $task): ?>
                        <div class="task-tools">
                            <a href="<?= Url::to('index.php?r=task%2Fview&id='.$task['id']) ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                            <a href="<?= Url::to('index.php?r=task%2Fupdate&id='.$task['id']) ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                            <a href="<?= Url::to('index.php?r=task%2Fdelete&id='.$task['id']) ?>"><span class="glyphicon glyphicon-trash"></span></a>
                        </div>
                        <div class="task-wrapper">
                            <span class="task-title"><?= $task['title'] ?></span>
                            <span class="task-description"><?= $task['description'] ?></span>
                            <span>Estimated points: <?= $task['estimated_points']?></span>
                            <span>Assigned to: <?= $task['assigned_to'] ?></span>
                        </div>
                    <?php endforeach; ?>                
                <?php endforeach; ?>
            </div>
            <div class="col-lg-4">
                <h2>In Progress</h2>

            </div>
            <div class="col-lg-4">
                <h2>Completed</h2>

            </div>
        </div>
    </div>

    </div>
</div>
