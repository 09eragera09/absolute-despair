<?php
/**
 * Created by PhpStorm.
 * User: eragera
 * Date: 28/6/18
 * Time: 11:13 AM
 */

session_start();
error_reporting(E_ALL);
ini_set('display_errors', true);

define('DB_HOST', 'localhost');
define('DB_NAME', 'blog');
define('DB_USERNAME', 'eragera');
define('DB_PASSWORD', '23847442');
define('BASE_URL', 'http://localhost:3000');


$dsn = "mysql:host=".DB_HOST."; dbname=".DB_NAME."; charset=UTF8";

$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $db = new PDO($dsn, DB_USERNAME, DB_PASSWORD , $opt);
}
catch ( Exception $e ) {
    die($e->getMessage());
}