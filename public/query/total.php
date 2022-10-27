<?php
function getComing()
{
    $coming = 'Coming';

    $sql = "SELECT `type`,
            SUM(`sum`) AS coming_sum
            FROM `records` 
            WHERE `type` = '{$coming}'";

    $result = connectPdo()->query($sql);
    return $result->fetch();
}

function getExpenditure()
{
    $expenditure = 'Expenditure';

    $sql = "SELECT `type`,
            SUM(`sum`) AS expenditure_sum
            FROM `records` 
            WHERE `type` = '{$expenditure}'";

    $result = connectPdo()->query($sql);
    return $result->fetch();
}

function connectPdo(): PDO|string
{
    $user = 'root';
    $pass = 123123;
    $db = 'spa';
    $host = 'spa_db';
    $charset = 'utf8';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    try {
        return new PDO($dsn, $user, $pass, $opt);
    } catch (PDOException $e) {
        return "Error!: " . $e->getMessage() . "<br/>";
    }
}

$arrSumAllType = [];
$arrSumAllType[] = getComing();
$arrSumAllType[] = getExpenditure();
print json_encode($arrSumAllType);