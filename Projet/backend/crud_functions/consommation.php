<?php

// Fonctions pour le journal

function getConsommation($pdo, $userId)
{

    $sql = "SELECT  aliments.nom, consomme.quantité, consomme.date_consommation, id_consomme
    FROM consomme
    INNER JOIN aliments ON consomme.id_alim = aliments.id
    INNER JOIN users ON consomme.id_user = users.id_user
    WHERE users.id_user = :userId
    ORDER BY consomme.date_consommation DESC;    
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // $resultat['id_user'] = $userId;
    return $resultat;

}

function addConsommation($pdo, $idUser, $idAliment, $quantite, $dateConsommation)
{
    $sql = "SET FOREIGN_KEY_CHECKS=0;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $sql = "INSERT INTO consomme(id_alim,id_user,quantité,date_consommation)
    VALUES(:idAliment,:idUser,:quantite,:dateConsommation);";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idUser', $idUser);
    $stmt->bindParam(':idAliment', $idAliment);
    $stmt->bindParam(':quantite', $quantite);
    $stmt->bindParam(':dateConsommation', $dateConsommation);
    $stmt->execute();

    $lastInsertedId = $pdo->lastInsertId();

    $sql = "SET FOREIGN_KEY_CHECKS=1;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $sql = "SELECT  aliments.nom, consomme.quantité, consomme.date_consommation, id_consomme
    FROM consomme
    INNER JOIN aliments ON consomme.id_alim = aliments.id
    INNER JOIN users ON consomme.id_user = users.id_user
    WHERE consomme.id_consomme = :lastInsertedId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':lastInsertedId', $lastInsertedId);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function deleteConsommation($pdo, $idConsomme)
{

    $request = $pdo->prepare("DELETE FROM consomme 
    WHERE id_consomme = $idConsomme");
    $request->execute();

}

function updateConsommation($pdo, $id_consomme, $quantite, $dateConsommation)
{

    $sql = "UPDATE consomme 
    SET quantité = :quantite, date_consommation = :dateConsommation 
    WHERE id_consomme = :id_consomme";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_consomme', $id_consomme);
    $stmt->bindParam(':quantite', $quantite);
    $stmt->bindParam(':dateConsommation', $dateConsommation);
    $stmt->execute();

    $sql = "SELECT  aliments.nom, consomme.quantité, consomme.date_consommation
    FROM consomme
    INNER JOIN aliments ON consomme.id_alim = aliments.id
    WHERE consomme.id_consomme = :id_consomme
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_consomme', $id_consomme);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>