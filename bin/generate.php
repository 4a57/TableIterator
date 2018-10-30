<?php

$db = include __DIR__ . '/../db.php';
$recordsToGenerate = isset($argv[1]) ? intval($argv[1]) : 1500;

$start = microtime(true);
$position = 0;

for ($i = 0; $i < $recordsToGenerate; $i += 100) {
    $query = <<<SQL
INSERT INTO `big_table`(`name`, `address`, `age`, `phone`) VALUES
SQL;
    for ($j = 0; $j < 100; $j++) {
        $name = substr(uniqid(), mt_rand(0, 9));
        $address = substr(uniqid(), mt_rand(0, 9)) . ' ' . substr(uniqid(), mt_rand(0, 9));
        $age = mt_rand(1, 150);
        $phone = mt_rand(500000000, 900000000);

        $query .= <<<SQL
('{$name}', '{$address}', {$age}, '{$phone}'),
SQL;
    }

    $position += $j;
    echo "\n" . $position . '/' . $recordsToGenerate;

    $db->query(substr($query, 0, strlen($query) - 1));
}

$end = microtime(true);
$time = ($end - $start);

echo "\n" . '================================' . "\n"
    . 'Add ' . $recordsToGenerate . ' rows in ' . $time . ' seconds';
