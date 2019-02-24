<?php

return [
    'adminEmail' => 'admin@example.com',
    'createTask' => $_SERVER['HTTP_HOST'] . '/arbel_api/task/create.php',
    'editTask' => $_SERVER['HTTP_HOST'] . '/arbel_api/task/update.php',
    'deleteTask' => $_SERVER['HTTP_HOST'] . '/arbel_api/task/delete.php',
    'listTasks' => $_SERVER['HTTP_HOST'] . '/arbel_api/task/read.php',
    'showTask' => $_SERVER['HTTP_HOST'] . '/arbel_api/task/read_one.php',
    'listUsers' => $_SERVER['HTTP_HOST'] . '/arbel_api/user/read.php',
    'createUser' => $_SERVER['HTTP_HOST'] . '/arbel_api/user/create.php',
    'updateUser' => $_SERVER['HTTP_HOST'] . '/arbel_api/user/update.php',
    'deleteUser' => $_SERVER['HTTP_HOST'] . '/arbel_api/user/delete.php',
];
