<?php

// Fonctions pour le journal

function getConsommationHebdo($pdo, $userId, $id_nutriment)
{

    $sql = "SELECT SUM(consomme.quantité * contient.quantité / 100) AS hebdo
    FROM contient
    INNER JOIN consomme ON consomme.id_alim = contient.id_alim 
    WHERE consomme.id_user = :userId 
    AND contient.id_nut = :id_nutriment 
    AND consomme.date_consommation >= DATE_SUB(CURDATE(), INTERVAL 7 DAY);
    
";


    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':id_nutriment', $id_nutriment);
    $stmt->execute();
    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;

}

