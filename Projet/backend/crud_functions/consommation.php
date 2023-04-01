<?php

// Fonctions pour le journal

function getConsommation($pdo, $userId)
{
    $sql = "SELECT aliments.nom_aliment, SUM(consomme.quantite) AS total_quantite
    FROM consomme
    INNER JOIN aliments ON consomme.id_aliment = aliments.id_aliment
    INNER JOIN users ON consomme.id_user = users.id
    WHERE users.id = :userId
    GROUP BY aliments.nom;
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();

}

function addConsommation($pdo,$idUser,$idAliment,$quantite,$dateConsommation)
{
    $sql = "INSERT INTO consomme
    VALUES(:idUser,:idAliment,:quantite,:dateConsommation);";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idUser', $idUser);
    $stmt->bindParam(':idAliment', $idAliment);
    $stmt->bindParam(':quantite', $quantite);
    $stmt->bindParam(':dateConsommation', $dateConsommation);
    $stmt->execute();
}

function deleteConsommation($pdo,$idUser,$idAliment){
    
    $request = $pdo->prepare("DELETE FROM consomme 
    WHERE id_user = $idUser AND id_alim = $idAliment");
    $request->execute();

}

function updateConsommation($pdo,$idUser,$idAliment,$quantite,$dateConsommation){
    
    $sql = "UPDATE consomme 
    SET quantite = :quantite, date_consommation = :dateConsommation 
    WHERE id_user = :idUser AND id_alim = :idAliment";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idUser', $idUser);
    $stmt->bindParam(':idAliment', $idAliment);
    $stmt->bindParam(':quantite', $quantite);
    $stmt->bindParam(':dateConsommation', $dateConsommation);
    $stmt->execute();

}
?>