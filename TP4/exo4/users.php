<!DOCTYPE html>
<html>
<?php
$_params = $_POST;
require_once('config.php');
require_once('crud_functions.php');
try {
    $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connexion réussie';

    // On process la demande d'ajout d'un utilisateur
    if (isset($_params['mail']) && isset($_params['name']) && isset($_params['action']) && $_params['action'] == 'add') {
        $mail = $_params['mail'];
        $name = $_params['name'];
        addUser($pdo,$name,$mail);
    }


    // On process la demande de supression d'un utilisateur 
    if (isset($_params['id']) && isset($_params['action']) && $_params['action'] == 'delete') {
        $id = $_params['id'];
        deleteUser($pdo,$id);
    }

    if (isset($_params['id']) && isset($_params['action']) && $_params['action'] == 'edit') {
        $id = $_params['id'];
        $name = $_params['name'];
        $email = $_params['email'];
        updateUser($pdo, $id, $name, $email);
    }
    

    $resultat = getUsers($pdo);


} catch (PDOException $erreur) {
    echo "Erreur : " . $erreur->getMessage();

}
?>

<head>
    <title>page d'accueil</title>
    <meta charset="utf-8">
    <!-- <link rel="stylesheet" href="cours.css"> -->
</head>

<body>
    <h1>Bases de données MySQL</h1>
    <table>
        <tr> <!-- tr indique qu'on ajoute une nouvelle ligne au tableau, à l'intérieur de cette balise on ajoute les éléments un par un -->
            <th>ID</th> <!-- th indique qu'on ajoute un élément qui sera un titre -->
            <th>Nom</th>
            <th>Mail</th>
            <th>Supprimer</th>
            <th>Modifier</th>
        </tr>
        <?php

        foreach ($resultat as $user) {
            

            echo '<tr>';
            echo "<td> {$user['id']} </td>"; // td indique qu'on ajoute un élément qui sera une valeur
            echo "<td> {$user['name']} </td>";
            echo "<td> {$user['email']} </td>";
            //Le bouton supprimer
            echo '<td>';
            echo "<form method='post' action='users.php'>";
            echo "<input type='hidden' name='id' value='{$user['id']}'/>";
            echo "<input type='hidden' name='action' value='delete' />";
            echo "<input type='submit' value='Supprimer'/>";
            echo "</form>";
            echo '</td>';
            // Le bouton modifier 
            echo "<td>";
            echo "<form method='post' action='users.php'>";
            echo "<input type='hidden' name='id' value='{$user['id']}'/>";
            echo "<input type='hidden' name='action' value='edit' />";
            echo "<input type='text' name='name' value='{$user['name']}'/>";
            echo "<input type='mail' name='email' value='{$user['email']}'/>";
            echo "<input type='submit' value='Modifier' />";
            echo "</form>";
            echo "</td>";

            echo '</tr>';
        }
        echo "</table>";

        echo "<form method = 'post' action='users.php'>";
        echo "<input type='hidden' name='action' value='add' />";
        echo "<label for='name'>Nom et prénom </label>";
        echo "<input type='text' name='name' id='name' />";
        echo "<label for='mail'> adresse mail </label>";
        echo "<input type='text' name='mail' id='mail' />";
        echo "<input type='submit' value='Ajouter' />";
        echo "</form>";

        $pdo = null;
        ?>
</body>

</html>