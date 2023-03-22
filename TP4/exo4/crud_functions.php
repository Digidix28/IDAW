<?php

function addUser($pdo, $name, $mail)
{
    $stmt = $pdo->prepare("INSERT INTO users(name, email) VALUES ('$name', '$mail')");

    $stmt->execute();
}

function getUsers($pdo)
{
    $request = $pdo->prepare("select * from users");
    $request->execute();

    $resultat = $request->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
}

function deleteUser($pdo,$id){

    $request = $pdo->prepare("DELETE FROM users WHERE id = $id");
    $request->execute();
}

function updateUser($pdo, $id, $name, $email) {
    $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
}

?>