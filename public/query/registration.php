<?php

$email = trim($_POST['email']) ?? null;
$password = trim($_POST['password']) ?? null;

function registration(string $email, string $password): void
{
    $responseData = checkExistEnter($email, $password);

    if (!$responseData) {

        $userData = registerNewUser($email, $password);

        if ($userData) {
            $responseData[] = [
                'status' => 1,
                'message' => 'User successfully registered',
                'user_email' => $email
            ];
            $_SESSION['user'] = $userData;
            setcookie("user", $userData['email'], time()+360000);
        } else {
            $responseData[] = [
                'status' => 0,
                'message' => 'Registration error'
            ];
        }
    }
    print json_encode($responseData);
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

function registerNewUser(string $email, string $password): array|string
{
    $data = [
        'email' => htmlspecialchars(trim($_POST['email'])),
        'password' => htmlspecialchars(trim($_POST['password']))
    ];

    $sql = "INSERT INTO
                `users` (`email`, `password`)
            VALUES
                (:email, :password)";

    $records = connectPdo()->prepare($sql);
    $records->execute($data);

    if ($records) {
        $sql = "SELECT *
                FROM `users`
                WHERE (`email` = :email)
                LIMIT 1";

        $records = connectPdo()->prepare($sql);
        $records->execute([$data['email']]);
        return $records->fetch();
    } else {
        return 'error';
    }
}

registration($email, $password);