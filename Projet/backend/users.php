<?php
header('Content-Type: application/json');
require_once("crud_functions/users.php");
require_once("config.php");


try {
    $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $request_method = $_SERVER["REQUEST_METHOD"];
    switch ($request_method) {
        case 'GET':
            $users = getUsers($pdo);
            $res = ["data" => $users];
            echo json_encode($res);
            break;
        case 'POST':
            //$name, $prenom, $mail , $sexe , $age , $mdp, $poid
            if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['login']) && isset($_POST['sexe'])&& isset($_POST['age'])&& isset($_POST['mdp'])&& isset($_POST['poid'])) {
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $login = $_POST['login'];
                $sexe = $_POST['sexe'];
                $age = $_POST['age'];
                $mdp = $_POST['mdp'];
                $poid = $_POST['poid'];
                addUser($pdo, $nom, $prenom, $mail, $sexe, $age, $mdp, $poid);
                http_response_code(201); // set HTTP status code to 201
            } else {
                http_response_code(400);
            }
            break;
        case 'DELETE':
            if (isset($_GET['id_user'])) {
                $id = $_GET['id'];
                deleteUser($pdo, $id);
            }
        case 'PUT':
            if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['login']) && isset($_POST['sexe'])&& isset($_POST['age'])&& isset($_POST['mdp'])&& isset($_POST['poid'])&& isset($_POST['id_user'])){
                $id = $_POST['id_user'];
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $login = $_POST['login'];
                $sexe = $_POST['sexe'];
                $age = $_POST['age'];
                $mdp = $_POST['mdp'];
                $poid = $_POST['poid'];
            }
            updateUser($pdo, $id, $nom, $prenom, $mail, $sexe, $age, $mdp, $poid);
            break;


    }
} catch (PDOException $erreur) {
    http_response_code(500);
    echo "Erreur : " . $erreur->getMessage();

}