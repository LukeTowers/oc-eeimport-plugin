<?php return [

    // The default database connection to use as a source for ExpressionEngine data
    'default_ee_connection' => 'expressionengine',

    // The ExpressionEngine database connections that get dynamically added to the
    // overall available DB connections
    'connections' => [
        'expressionengine' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST', 'localhost'),
            'port'      => env('DB_PORT', 3306),
            'database'  => 'expressionengine',
            'username'  => env('DB_USERNAME', ''),
            'password'  => env('DB_PASSWORD', ''),
            'charset'   => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix'    => 'exp_',
        ],
    ],

];