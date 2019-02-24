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

    <p>
        <?php // Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::button('Create User', ['id' => 'createUser', 'value' => Url::to(['create']), 'class' => 'btn btn-primary btn-create-user']) ?>
        <?= $this->render('../layouts/modal') ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name:ntext',
            'last_name:ntext',
            'group_id',
            'username',
            //'password',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
