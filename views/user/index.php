<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// If user is not logged in it should redirect to login page
if(Yii::$app->user->getIsGuest()){
    Yii::$app->response->redirect(['site/login']);
}

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="edit-tools">
        <div class="edit-option">
            <?= Html::button('Create User', ['id' => 'createUser', 'value' => Url::to(['create']), 'class' => 'btn btn-primary btn-create-user']) ?>
            <?= $this->render('../layouts/modal') ?>
        </div>
        <div class="edit-option">
            <?= Html::button('Search User', ['id' => 'searchUser', 'value' => Url::to(['search']), 'class' => 'btn btn-secondary btn-round']) ?>
            <?= $this->render('../layouts/searchModal') ?>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name:ntext',
            'last_name:ntext',
            'team_name',
            'username',
            //'password',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
