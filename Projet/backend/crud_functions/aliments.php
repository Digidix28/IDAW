<?php

// Fonctions basiques
function addAliment($pdo, $name, $id_type)
{
    $stmt = $pdo->prepare("INSERT INTO aliments(nom,id_type) VALUES ('$name','$id_type')");
    $stmt->execute();

}

function getAliments($pdo)
{
    $request = $pdo->prepare("select * from aliments");
    $request->execute();

    $resultat = $request->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
}

function deleteAliments($pdo, $id)
{

    $request = $pdo->prepare("DELETE FROM aliments WHERE id = $id");
    $request->execute();
}

function updateAliments($pdo, $id, $nom , $id_type)
{
    $sql = "UPDATE aliments 
    SET nom = :nom,
    id_type = :id_type
    WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $nom);
    $stmt->bindParam(':id_type', $id_type);
    $stmt->execute();
}

?>