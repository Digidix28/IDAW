<?php
header('Content-Type: application/json');
require_once("../crud_functions/aliments.php");
require_once("config.php");

try {
    $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $request_method = $_SERVER["REQUEST_METHOD"];
    switch ($request_method) {
        case 'GET':
            $aliments = getAliments($pdo);
            $res = ["data" => $aliments];
            echo json_encode($res);
            break;
        case 'POST':
            if (isset($_POST['nom'])&&isset($_POST['id_type'])) {
                $name = $_POST['nom'];
                $id_type = $_POST['id_type'];
                addAliment($pdo, $name,$id_type );
                http_response_code(201); // set HTTP status code to 201
            } else {
                http_response_code(400);
            }
            break;
        case 'PUT':
            $json = file_get_contents('php://input');
            $put = json_decode($json, TRUE);
            $id = $put['id'];
            $nom = $put['nom'];
            $id_type = $put['id_type'];
            if(isset($id) && isset($nom)&& isset($id_type)){
                updateAliments($pdo, $id, $nom ,$id_type );
                http_response_code(201); // set HTTP status code to 201
            } else {
                http_response_code(400);
            }

            break;
        case 'DELETE':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                deleteAliments($pdo, $id);
            }

    }
} catch (PDOException $erreur) {
    http_response_code(500);
    echo "Erreur : " . $erreur->getMessage();

}

?>