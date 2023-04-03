<?php

// Fonctions pour le journal

function getConsommation($pdo, $userId)
{

    $sql = "SELECT aliments.nom, SUM(consomme.quantité) AS total_quantite
    FROM consomme
    INNER JOIN aliments ON consomme.id_alim = aliments.id
    INNER JOIN users ON consomme.id_user = :userId
    WHERE users.id_user = :userId
    GROUP BY aliments.nom;
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;

}

function addConsommation($pdo,$idUser,$idAliment,$quantite,$dateConsommation)
{
    // $sql = "SET FOREIGN_KEY_CHECKS=0;";

    // $stmt = $pdo->prepare($sql);
    // $stmt->execute();

    $sql = "INSERT INTO consomme
    VALUES(:idAliment,:idUser,:quantite,:dateConsommation);";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idUser', $idUser);
    $stmt->bindParam(':idAliment', $idAliment);
    $stmt->bindParam(':quantite', $quantite);
    $stmt->bindParam(':dateConsommation', $dateConsommation);
    $stmt->execute();

    // $sql = "SET FOREIGN_KEY_CHECKS=1;";

    // $stmt = $pdo->prepare($sql);
    // $stmt->execute();
}

function deleteConsommation($pdo,$idUser,$idAliment){
    
    $request = $pdo->prepare("DELETE FROM consomme 
    WHERE id_user = $idUser AND id_alim = $idAliment");
    $request->execute();

}

function updateConsommation($pdo,$idUser,$idAliment,$quantite,$dateConsommation){
    
    $sql = "UPDATE consomme 
    SET quantité = ':quantite', date_consommation = ':dateConsommation' 
    WHERE id_user = :idUser AND id_alim = :idAliment";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idUser', $idUser);
    $stmt->bindParam(':idAliment', $idAliment);
    $stmt->bindParam(':quantite', $quantite);
    $stmt->bindParam(':dateConsommation', $dateConsommation);
    $stmt->execute();

}
?>