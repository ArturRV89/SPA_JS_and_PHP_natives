<?php
function AllRecords()
{
    $sql = "SELECT *
            FROM `records`
            ORDER BY `id` DESC
            LIMIT 10";

    $result = connectPdo()->query($sql);
    return $result->fetchAll();
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
echo json_encode(AllRecords());