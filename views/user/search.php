<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Search User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-search">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_searchForm', [
        'model' => $model,
    ]) ?>

</div>