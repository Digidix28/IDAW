<?php

function addUser($pdo, $nom, $prenom, $login , $sexe , $age , $mdp, $poid)
{
    $stmt = $pdo->prepare("INSERT INTO users( nom , login , prenom , sexe , age , mdp , poid ) VALUES ('$nom', '$login', '$prenom', '$sexe' , '$age' , '$mdp', '$poid')");
    $stmt->execute();   

    $id = $pdo->lastInsertId();

    echo '{ "id_user" : ' . $id . '}';
}

function getUsers($pdo)
{
    $request = $pdo->prepare("select * from users");
    $request->execute();

    $resultat = $request->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
}

function deleteUser($pdo,$id){

    $request = $pdo->prepare("DELETE FROM users WHERE id_user = $id");
    $request->execute();
}

function updateUser($pdo, $id, $nom, $prenom, $login , $sexe , $age , $mdp, $poid) {
    $sql = "UPDATE users 
            SET 
            nom = :nom, 
            prenom = :prenom, 
            login = :login,
            sexe = :sexe ,
            age = :age,
            mdp = :mdp,
            poid = :poid
            WHERE id_user = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':sexe', $sexe);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':mdp', $mdp);
    $stmt->bindParam(':poid', $poid);
    $stmt->execute();
}

?>