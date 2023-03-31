<?php

// Fonctions basiques
function addAliment($pdo, $name, $mail)
{
    $stmt = $pdo->prepare("INSERT INTO aliments(nom) VALUES ('$name')");
    $stmt->execute();

    $id = $pdo->lastInsertId();

    echo '{ "id" : ' . $id . '}';
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

function updateAliments($pdo, $id, $name)
{
    $sql = "UPDATE aliments SET nom = :name WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->execute();
}

?>