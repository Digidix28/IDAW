<?php
function addUser($pdo, $nom, $prenom, $login, $sexe, $age, $mdp, $poid)
{
    $stmt = $pdo->prepare("INSERT INTO users( nom , login , prenom , sexe , age , mdp , poid ) VALUES ('$nom', '$login', '$prenom', '$sexe' , '$age' , '$mdp', '$poid')");
    $stmt->execute();
    $id = $pdo->lastInsertId();
    return $id ;
}
function getUsers($pdo, $login, $mdp)
{
    $request = $pdo->prepare("SELECT id_user FROM users WHERE login = :login AND mdp = :mdp");
    $request->execute(['login' => $login, 'mdp' => $mdp]);
    $resultat = $request->fetchAll(PDO::FETCH_ASSOC);
    $user_exists = count($resultat) > 0;
    $user_id = $user_exists ? $resultat[0]['id_user'] : null;
    return ['user_exists' => $user_exists, 'id_user' => $user_id];
}

function deleteUser($pdo, $id)
{
    $request = $pdo->prepare("DELETE FROM users WHERE id_user = $id");
    $request->execute();
}
function updateUser($pdo, $id, $nom, $prenom, $login, $sexe, $age, $mdp, $poid)
{
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
    echo $sql;
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