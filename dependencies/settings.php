<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

return array(

    'slim' => array(
        // Returns a detailed HTML page with error details and
        // a stack trace. Should be disabled in production.
        'displayErrorDetails' => true,

        // Whether to display errors on the internal PHP log or not.
        'logErrors' => true,

        // If true, display full errors with message and stack trace on the PHP log.
        // If false, display only "Slim Application Error" on the PHP log.
        // Doesn't do anything when 'logErrors' is false.
        'logErrorDetails' => true,
    ),

    'doctrine' => array(
        // Enables or disables Doctrine metadata caching
        // for either performance or convenience during development.
        'dev_mode' => true,

        // Path where Doctrine will cache the processed metadata
        // when 'dev_mode' is false.
        'cache_dir' => __DIR__ . '/var/doctrine',

        // List of paths where Doctrine will search for metadata.
        // Metadata can be either YML/XML files or PHP classes annotated
        // with comments or PHP8 attributes.
        'metadata_dirs' => array(__DIR__ . '/../src/model/'),

        // The parameters Doctrine needs to connect to your database.
        // These parameters depend on the driver (for instance the 'pdo_sqlite' driver
        // needs a 'path' parameter and doesn't use most of the ones shown in this example).
        // Refer to the Doctrine documentation to see the full list
        // of valid parameters: https://www.doctrine-project.org/projects/doctrine-dbal/en/current/reference/configuration.html
        'connection' => array(
            'driver' => 'pdo_mysql',
            'host' => $_ENV["DB_HOST"],
            'port' => 3306,
            'dbname' => $_ENV["DB_NAME"],
            'user' => $_ENV["DB_USER"],
            'password' => $_ENV["DB_PASS"],
            // 'charset' => 'utf-8'
        ),

    ),

    'db' => array(
        'user' => $_ENV['DB_USER'],
        'pass' => $_ENV['DB_PASS'],
        'db' => $_ENV['DB_NAME'],
    ),

);