<?php
header('Content-Type: application/json');
require_once("../crud_functions/consommation.php");
require_once("config.php");

try {
    $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $request_method = $_SERVER["REQUEST_METHOD"];
    switch ($request_method) {
        case 'GET':
            if(isset($_GET['user_id'])){
                $userId = $_GET['user_id'];
                $consommation = getConsommation($pdo, $userId);
                $res = [ "data" => $consommation];
                echo json_encode($res);
            } else {

                http_response_code(400);
            }
            break;
        case 'POST':
            if (isset($_POST['user_id']) && isset($_POST['aliment_id']) && isset($_POST['quantite']) && isset($_POST['date_consommation'])) {
                $idUser = $_POST['user_id'];
                $idAliment = $_POST['aliment_id'];
                $quantite = $_POST['quantite'];
                $dateConsommation = $_POST['date_consommation'];
                addConsommation($pdo, $idUser, $idAliment, $quantite, $dateConsommation);
                http_response_code(201); // set HTTP status code to 201
            } else {
                http_response_code(400);
            }
            break;
        case 'DELETE':
            if(isset($_GET['user_id']) && isset($_GET['aliment_id'])){
                $idUser = $_GET['user_id'];
                $idAliment = $_GET['aliment_id'];
                deleteConsommation($pdo, $idUser, $idAliment);
                http_response_code(201);
            } else {
                http_response_code(400);
            }
            break;
        case 'PUT':
            if (isset($_POST['user_id']) && isset($_POST['aliment_id']) && isset($_POST['quantite']) && isset($_POST['date_consommation'])) {
                $idUser = $_POST['user_id'];
                $idAliment = $_POST['aliment_id'];
                $quantite = $_POST['quantite'];
                $dateConsommation = $_POST['date_consommation'];
                updateConsommation($pdo, $idUser, $idAliment, $quantite, $dateConsommation);
                http_response_code(201); // set HTTP status code to 201
            } else {
                http_response_code(400);
            }
            break;
        default:
            http_response_code(405);
            break;
    }
} catch (PDOException $erreur) {
    http_response_code(500);
    echo "Erreur : " . $erreur->getMessage();

}
?>
