<?php

use yii\bootstrap\Modal;

Modal::begin([
    'header' => '<h4>Search for an element</h4>',
    'id'     => 'searchModel',
    'size'   => 'model-lg',
]);

echo "<div id='searchModelContent'></div>";

Modal::end();