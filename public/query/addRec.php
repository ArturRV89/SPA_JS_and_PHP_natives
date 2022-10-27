<?php
$sum = $_POST['sum'];
$type = $_POST['type'];
$comment = $_POST['comment'];

function addRecords(int $sum, $type, string $comment): bool|string
{
    $recordsData = addNewRecords($sum, $type, $comment);
    if ($recordsData) {
        $responseData[] = [
            'status' => 1,
            'message' => 'Data successfully added'
        ];
    } else {
        $responseData[] = [
            'status' => 0,
            'message' => 'Error Added'
        ];
    }
    return json_encode($responseData);
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

function addNewRecords(int $sum, $type, string $comment): bool
{
    $data = [
        'sum' => htmlspecialchars(trim($_POST['sum'])),
        'type' => htmlspecialchars(trim($_POST['type'])),
        'comment' => htmlspecialchars(trim($_POST['comment']))
    ];

    $sql = "INSERT INTO
                `records` (`sum`, `type`, `comment`)
            VALUES
                (:sum, :type, :comment)";

    $records = connectPdo()->prepare($sql);
    return $records->execute($data);
}

addRecords($sum, $type, $comment);