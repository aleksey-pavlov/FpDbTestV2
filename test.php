<?php

use FpDbTest\Database;
use FpDbTest\DatabaseTemplate;
use FpDbTest\DatabaseTest;

spl_autoload_register(function ($class) {
    $a = array_slice(explode('\\', $class), 1);
    if (!$a) {
        throw new Exception();
    }
    $filename = implode('/', [__DIR__, ...$a]) . '.php';
    require_once $filename;
});

$mysqli = @new mysqli('127.0.0.1', 'root', 'password', 'database', 3306);
if ($mysqli->connect_errno) {
    throw new Exception($mysqli->connect_error);
}

$msc = microtime(true);

$db = new Database($mysqli, new DatabaseTemplate());
$test = new DatabaseTest($db);
$test->testBuildQuery();   

echo round(microtime(true) - $msc, 4)."\n";

exit('OK');