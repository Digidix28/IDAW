
    <?php
    require_once('config.php');
    
    try {
        $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo 'Connexion réussie';

         // Création et remplissage des tables (le code de la requête SQL pour le faire est écrit dans l'export)
         $create_table_request = file_get_contents("users.sql");
         $pdo->exec($create_table_request);
        print('db recreated');

    } catch (PDOException $erreur) {
       echo $erreur -> getMessage();
       print($erreur -> getMessage());
    }

?>