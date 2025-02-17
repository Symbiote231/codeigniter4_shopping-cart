<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to use if no other is specified.
     */
    public string $defaultGroup = 'default';

    /**
     * The default database connection.
     *
     * @var array<string, mixed>
     */
    public array $default = [
        'DSN'          => '', // A Data Source Name string, used for custom or advanced database connection settings. Leave empty when using standard connection parameters like hostname, username, and password.
        'hostname'     => 'localhost', // The server running MySQL.
        'username'     => 'shopping_user', // MySQL user for your app.
        'password'     => 'ShoppingPass', // Secure password for the user.
        'database'     => 'shopping_cart', // Name of the database your app will use.
        'DBDriver'     => 'MySQLi', // PHP's MySQL driver; faster than PDO for MySQL.
        'DBPrefix'     => '', // Prefix for table names, optional.
        'pConnect'     => false, // Persistent connection; false is usually better.
        'DBDebug'      => true, // Enables error reporting for queries during development.
        'charset'      => 'utf8mb4', // UTF-8 with full Unicode support (e.g., emojis).
        'DBCollat'     => 'utf8mb4_general_ci', // Case-insensitive collation for strings.
        'swapPre'      => '', // Optional prefix swapping for migrations.
        'encrypt'      => false, // Enable if using encrypted connections.
        'compress'     => false, // Enable if using compressed connections.
        'strictOn'     => false, // Strict mode for SQL queries; usually off by default.
        'failover'     => [], // Specify backup connection details.
        'port'         => 3306, // MySQL default port.
        'numberNative' => false, // Optional; leave as false for now.
        'dateFormat'   => [
            'date'     => 'YYYY-mm-dd', // MySQL standard date format.
            'datetime' => 'YYYY-mm-dd HH:ii:ss', // MySQL datetime format.
            'time'     => 'HH:ii:ss', // MySQL time format.
        ],
    ];

    //    /**
    //     * Sample database connection for SQLite3.
    //     *
    //     * @var array<string, mixed>
    //     */
    //    public array $default = [
    //        'database'    => 'database.db',
    //        'DBDriver'    => 'SQLite3',
    //        'DBPrefix'    => '',
    //        'DBDebug'     => true,
    //        'swapPre'     => '',
    //        'failover'    => [],
    //        'foreignKeys' => true,
    //        'busyTimeout' => 1000,
    //        'dateFormat'  => [
    //            'date'     => 'Y-m-d',
    //            'datetime' => 'Y-m-d H:i:s',
    //            'time'     => 'H:i:s',
    //        ],
    //    ];

    //    /**
    //     * Sample database connection for Postgre.
    //     *
    //     * @var array<string, mixed>
    //     */
    //    public array $default = [
    //        'DSN'        => '',
    //        'hostname'   => 'localhost',
    //        'username'   => 'root',
    //        'password'   => 'root',
    //        'database'   => 'ci4',
    //        'schema'     => 'public',
    //        'DBDriver'   => 'Postgre',
    //        'DBPrefix'   => '',
    //        'pConnect'   => false,
    //        'DBDebug'    => true,
    //        'charset'    => 'utf8',
    //        'swapPre'    => '',
    //        'failover'   => [],
    //        'port'       => 5432,
    //        'dateFormat' => [
    //            'date'     => 'Y-m-d',
    //            'datetime' => 'Y-m-d H:i:s',
    //            'time'     => 'H:i:s',
    //        ],
    //    ];

    //    /**
    //     * Sample database connection for SQLSRV.
    //     *
    //     * @var array<string, mixed>
    //     */
    //    public array $default = [
    //        'DSN'        => '',
    //        'hostname'   => 'localhost',
    //        'username'   => 'root',
    //        'password'   => 'root',
    //        'database'   => 'ci4',
    //        'schema'     => 'dbo',
    //        'DBDriver'   => 'SQLSRV',
    //        'DBPrefix'   => '',
    //        'pConnect'   => false,
    //        'DBDebug'    => true,
    //        'charset'    => 'utf8',
    //        'swapPre'    => '',
    //        'encrypt'    => false,
    //        'failover'   => [],
    //        'port'       => 1433,
    //        'dateFormat' => [
    //            'date'     => 'Y-m-d',
    //            'datetime' => 'Y-m-d H:i:s',
    //            'time'     => 'H:i:s',
    //        ],
    //    ];

    //    /**
    //     * Sample database connection for OCI8.
    //     *
    //     * You may need the following environment variables:
    //     *   NLS_LANG                = 'AMERICAN_AMERICA.UTF8'
    //     *   NLS_DATE_FORMAT         = 'YYYY-MM-DD HH24:MI:SS'
    //     *   NLS_TIMESTAMP_FORMAT    = 'YYYY-MM-DD HH24:MI:SS'
    //     *   NLS_TIMESTAMP_TZ_FORMAT = 'YYYY-MM-DD HH24:MI:SS'
    //     *
    //     * @var array<string, mixed>
    //     */
    //    public array $default = [
    //        'DSN'        => 'localhost:1521/XEPDB1',
    //        'username'   => 'root',
    //        'password'   => 'root',
    //        'DBDriver'   => 'OCI8',
    //        'DBPrefix'   => '',
    //        'pConnect'   => false,
    //        'DBDebug'    => true,
    //        'charset'    => 'AL32UTF8',
    //        'swapPre'    => '',
    //        'failover'   => [],
    //        'dateFormat' => [
    //            'date'     => 'Y-m-d',
    //            'datetime' => 'Y-m-d H:i:s',
    //            'time'     => 'H:i:s',
    //        ],
    //    ];

    /**
     * This database connection is used when running PHPUnit database tests.
     *
     * @var array<string, mixed>
     */
    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => '',
        'password'    => '',
        'database'    => ':memory:',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => 'db_',  // Needed to ensure we're working correctly with prefixes live. DO NOT REMOVE FOR CI DEVS
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => '',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => false,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
        'dateFormat'  => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

    public function __construct()
    {
        parent::__construct();

        // Ensure that we always set the database group to 'tests' if
        // we are currently running an automated test suite, so that
        // we don't overwrite live data on accident.
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }

        $this->default = [
            'DSN'          => '', // A Data Source Name string, used for custom or advanced database connection settings. Leave empty when using standard connection parameters like hostname, username, and password.
            'hostname'     => $_ENV['DB_HOST'] ?? 'localhost', // The server running MySQL.
            'username'     => $_ENV['DB_USERNAME'] ?? 'shopping_user', // MySQL user for your app.
            'password'     => $_ENV['DB_PASSWORD'] ?? 'ShoppingPass', // Secure password for the user.
            'database'     => $_ENV['DB_DATABASE'] ?? 'shopping_cart', // Name of the database your app will use.
            'DBDriver'     => 'MySQLi', // PHP's MySQL driver; faster than PDO for MySQL.
            'DBPrefix'     => '', // Prefix for table names, optional.
            'pConnect'     => false, // Persistent connection; false is usually better.
            'DBDebug'      => true, // Enables error reporting for queries during development.
            'charset'      => 'utf8mb4', // UTF-8 with full Unicode support (e.g., emojis).
            'DBCollat'     => 'utf8mb4_general_ci', // Case-insensitive collation for strings.
            'swapPre'      => '', // Optional prefix swapping for migrations.
            'encrypt'      => false, // Enable if using encrypted connections.
            'compress'     => false, // Enable if using compressed connections.
            'strictOn'     => false, // Strict mode for SQL queries; usually off by default.
            'failover'     => [], // Specify backup connection details.
            'port'         => $_ENV['DB_PORT'] ?? 3306, // MySQL default port.
            'numberNative' => false, // Optional; leave as false for now.
            'dateFormat'   => [
            'date'     => 'YYYY-mm-dd', // MySQL standard date format.
            'datetime' => 'YYYY-mm-dd HH:ii:ss', // MySQL datetime format.
            'time'     => 'HH:ii:ss', // MySQL time format.
            ],
        ];
    }
}
