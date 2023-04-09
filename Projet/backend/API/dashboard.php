<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
header('Content-Type: application/json; charset=utf-8');
require_once("../crud_functions/dashboard.php");
require_once("config.php");

try {
    $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("set names utf8");


    $request_method = $_SERVER["REQUEST_METHOD"];
    switch ($request_method) {
        case 'GET':
            if (isset($_GET['user_id']) && isset($_GET['id_nutriment']) ) {
                $userId = $_GET['user_id'];
                $id_nutriment = $_GET['id_nutriment'];
                $consommationHebdo = getConsommationHebdo($pdo, $userId,$id_nutriment);
                $res = ["data" => $consommationHebdo];
                echo json_encode($res);
                http_response_code(200);
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