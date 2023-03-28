<?php
header('Content-Type: application/json');
require_once("crud_functions.php");
require_once("config.php");


try {
    $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $request_method = $_SERVER["REQUEST_METHOD"];
    switch ($request_method) {
        case 'GET':
            $users = getUsers($pdo);
            $res = [ "data" => $users];
            echo json_encode($res);
            break;
        case 'POST':
            if (isset($_POST['email']) && isset($_POST['name'])) {
                $name = $_POST['name'];
                $mail = $_POST['email'];
                addUser($pdo, $name, $mail);
                http_response_code(201); // set HTTP status code to 201
            } else {
                http_response_code(400);
            }

    }
} catch (PDOException $erreur) {
    http_response_code(500);
    echo "Erreur : " . $erreur->getMessage();

}
?>