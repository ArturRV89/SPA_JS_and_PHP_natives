<?php
$id = $_POST['id'];
$id = htmlspecialchars(trim($id));

function deleteRec($id)
{
    $sql = "DELETE FROM `records` 
            WHERE id = :id";

    $result = connectPdo()->prepare($sql);
    $result->execute([$id]);

    if ($result) {
        print json_encode(["statusCode"=>200]);
    }
    else {
        print json_encode(["statusCode"=>201]);
    }
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
deleteRec($id);