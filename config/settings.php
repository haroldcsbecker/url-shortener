<?php

// Error reporting for production
error_reporting(0);
ini_set('display_errors', '0');

// Timezone
date_default_timezone_set('	America/Sao_Paulo');

// Settings
$settings = [];

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';

// Error Handling Middleware settings
$settings['error'] = [

    // Should be set to false in production
    'display_error_details' => false,

    // Parameter is passed to the default ErrorHandler
    // View in rendered output by enabling the "displayErrorDetails" setting.
    // For the console and unit tests we also disable it
    'log_errors' => true,

    // Display error details in error log
    'log_error_details' => true,
];

// Database settings
$settings['db'] = [
    'driver' => 'mysql',
    'host' => '172.18.0.2',
    'username' => 'root',
    'database' => 'shortener',
    'password' => 'root',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'driver_options' => [
       // Turn off persistent connections
       PDO::ATTR_PERSISTENT => false,
       // Enable exceptions
       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
       // Emulate prepared statements
       PDO::ATTR_EMULATE_PREPARES => true,
       // Set default fetch mode to array
       PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
       // Set character set
       PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
    ],
];

return $settings;
