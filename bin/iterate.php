<?php

use App\MysqlRowsLoader;
use App\BigIterator;

require __DIR__ . '/../vendor/autoload.php';

$db = include __DIR__ . '/../db.php';
$mysqlRowsLoader = new MysqlRowsLoader($db, 'big_table');
$bigIterator = new BigIterator($mysqlRowsLoader);

$start = microtime(true);

foreach ($bigIterator as $row) {
    echo $row['id'] . ', ';
}

$end = microtime(true);
$time = ($end - $start);

echo '================================' . "\n"
    . 'Done in ' . $time . ' seconds';
