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
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Mail</th>
            <th>Supprimer</th>
        </tr>
        <?php

        foreach ($resultat as $user) {
            echo '<tr>';
            echo "<td> {$user['id']} </td>";
            echo "<td> {$user['name']} </td>";
            echo "<td> {$user['email']} </td>";
            echo '</tr>';
        }
        $pdo = null;
        ?>
</body>

</html>