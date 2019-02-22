<?php

use yii\bootstrap\Modal;

Modal::begin([
    'header' => '<h4>New Task</h4>',
    'id'     => 'modelTask',
    'size'   => 'model-lg',
]);

echo "<div id='modelContent'></div>";

Modal::end();