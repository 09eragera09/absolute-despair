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
define('BASE_URL', 'http://shitwaifu.moe/blog');
define('RECAPTCHA_URL','https://www.google.com/recaptcha/api/siteverify');
define('RECAPTCHA_SECRET_KEY', '6Lf8mmMUAAAAAJIotXD2G-0wvaeRDAc5QjT9CBp9');
define('RECAPTCHA_PUBLIC_KEY', '6Lf8mmMUAAAAAEkuy2GaRlpomKqvqe5TMmC4-1B4');

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