<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'production',
        // 'development' => [
        //     'adapter' => 'mysql',
        //     'host' => 'localhost',
        //     'name' => 'shortener',
        //     'user' => 'root',
        //     'pass' => 'root',
        //     'port' => '3306',
        //     'charset' => 'utf8',
        // ],
        'production' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'shortener',
            'user' => 'root',
            'pass' => 'root',
            'port' => '3306',
            'charset' => 'utf8',
        ],
        // 'testing' => [
        //     'adapter' => 'mysql',
        //     'host' => 'localhost',
        //     'name' => 'testing_db',
        //     'user' => 'root',
        //     'pass' => '',
        //     'port' => '3306',
        //     'charset' => 'utf8',
        // ]
    ],
    'version_order' => 'creation'
];
