<!DOCTYPE html>
<html>

<head>
    <title>page d'accueil</title>
    <meta charset="utf-8">
    <!-- <link rel="stylesheet" href="cours.css"> -->
</head>

<body>
    <h1>Bases de données MySQL</h1>
    <?php
    require_once('config.php');

    try {
        $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo 'Connexion réussie';

        $request = $pdo->prepare("select * from users");
        $request->execute();

        $resultat = $request->fetchAll(PDO::FETCH_ASSOC);


    } catch (PDOException $erreur) {
        echo "Erreur : " . $erreur->getMessage();

    }


    ?>
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
            echo "<input type='submit' value='Supprimer'/>";
            echo "</form>";
            echo '</td>';
            // Le bouton modifier 
            echo '<td>';
            echo "<form method = 'post' action = 'users.php>";
            echo "<input type='hidden' name='id' value='{$user['id']}'/>";
            echo "<input type='submit' value='Modifier'/>";
            echo "</form>";
            echo '</td>';
            echo '</tr>';
        }
        echo "</table>";

        echo "<form method = 'post' action='users.php'>";
        echo "<input type='text' name='name' />";
        echo "<input type='text' name='mail' />";
        echo "<input type='submit' value='Ajouter' />";
        echo "</form>";
 
        $pdo = null;
        ?>
</body>

</html>