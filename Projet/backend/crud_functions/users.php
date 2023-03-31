<?php

function addUser($pdo, $name, $prenom, $mail , $sexe , $age , $mdp, $poid)
{
    $stmt = $pdo->prepare("INSERT INTO users( nom , login , prenom , sexe , age , mdp , poid ) VALUES ('$name', '$mail', '$prenom', '$sexe' , '$age' , '$mdp', '$poid')");
    $stmt->execute();

    $id = $pdo->lastInsertId();

    echo '{ "id" : ' . $id . '}';
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

function updateUser($pdo, $id, $name, $prenom, $mail , $sexe , $age , $mdp, $poid) {
    $sql = "UPDATE users 
            SET 
            nom = :name, 
            login = :email,
            prenom = :prenom, 
            sexe = :sexe ,
            age = :age,
            mdp = :mdp,
            poid = :poid
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':login', $mail);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':sexe', $sexe);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':mdp', $mdp);
    $stmt->bindParam(':poid', $poid);
    $stmt->execute();
}

?>