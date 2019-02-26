<?php

use yii\bootstrap\Modal;

Modal::begin([
    'header' => '<h4>Add a new element</h4>',
    'id'     => 'model',
    'size'   => 'model-lg',
]);

echo "<div id='modelContent'></div>";

Modal::end();