<?php
$email = trim($_POST['email']) ?? null;
$password = trim($_POST['password']) ?? null;

function login(string $email, string $password)
{
    $errors = [];
    $checkedEnter = checkExistEnter($email, $password);
    $checkedEmail = checkExistUserEmail($email);

    if (!$checkedEmail) {
        $errors['message'] = "User with such ('{$email}') not exists";
    }

    if (!$checkedEnter && $checkedEmail) {
        if (isset($_SESSION['user'])) {
//            print 'Welcome';
            print json_encode($checkedEmail);
        } else {
            $_SESSION['user'] = $checkedEmail;
//            print 'Welcome';
            print json_encode($checkedEmail);
        }
    } else {
        $errors['message'] = 'Data failed validate';
    }
    if (!empty($errors)) {
        print json_encode($errors['message']);
    }
}

function checkExistEnter(string $email, string $password): array
{
    $response = [];

    if (!$email) {
        $response['message'] = 'Enter email';
    }
    if (!$password) {
        $response['message'] = 'Enter password';
    }
    return $response;
}

function checkExistUserEmail(string $email)
{
    $email = htmlspecialchars($email);

    $sql = "SELECT `id`, `email`
                FROM `users` 
                WHERE (`email` = :email)
                LIMIT 1";

    $records = connectPdo()->prepare($sql);
    $records->execute([$email]);
    return $records->fetch();
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

login($email, $password);