<?php
header('Content-Type: application/json');
require_once("../crud_functions/users.php");
require_once("config.php");


try {
    $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $request_method = $_SERVER["REQUEST_METHOD"];
    switch ($request_method) {
        case 'GET':
            if (isset($_GET['login']) && isset($_GET['mdp']))
            $login = $_GET['login'] ;
            $mdp = $_GET['mdp'] ;
            $user = getUsers($pdo, $login,$mdp);
            $res = ["data" => $user];
            echo json_encode($res);
            break;
        case 'POST':
            if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['login']) && isset($_POST['sexe']) && isset($_POST['age']) && isset($_POST['mdp']) && isset($_POST['poid'])) {
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $login = $_POST['login'];
                $sexe = $_POST['sexe'];
                $age = $_POST['age'];
                $mdp = $_POST['mdp'];
                $poid = $_POST['poid'];
                addUser($pdo, $nom, $prenom, $login, $sexe, $age, $mdp, $poid);
                http_response_code(201);
            } else {
                http_response_code(400);
            }
            break;


        case 'DELETE':
            if (isset($_GET['id_user'])) {
                $id = $_GET['id_user'];
                deleteUser($pdo, $id);
            }
            break;

        case 'PUT':
            $json = file_get_contents('php://input');
            $put = json_decode($json, TRUE);
            echo "je suis à l'extérieur du if ";
            if (isset($put['nom']) && isset($put['prenom']) && isset($put['login']) && isset($put['sexe']) && isset($put['age']) && isset($put['mdp']) && isset($put['poid']) && isset($put['id_user'])) {
                $id = $put['id_user'];
                $nom = $put['nom'];
                $prenom = $put['prenom'];
                $login = $put['login'];
                $sexe = $put['sexe'];
                $age = $put['age'];
                $mdp = $put['mdp'];
                $poid = $put['poid'];
                updateUser($pdo, $id, $nom, $prenom, $login, $sexe, $age, $mdp, $poid);
                http_response_code(201);
            } else {
                http_response_code(400);
            }
            break;


    }
} catch (PDOException $erreur) {
    http_response_code(500);
    echo "Erreur : " . $erreur->getMessage();

}