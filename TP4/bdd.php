<!DOCTYPE html>
<html>
    <head>
        <title>Cours PHP / MySQL</title>
        <meta charset="utf-8">
        <!-- <link rel="stylesheet" href="cours.css"> -->
    </head>
    <body>
        <h1>Bases de données MySQL</h1>  
        <?php
            require_once("config.php");
            
            //On essaie de se connecter
            try{
                $conn = new PDO("mysql:host="._MYSQL_SERVNAME.";dbname="._MYSQL_DBNAME, _MYSQL_USER, _MYSQL_PASSWORD);

                //On définit le mode d'erreur de PDO sur Exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo 'Connexion réussie';
            }
            
            /*On capture les exceptions si une exception est lancée et on affiche
             *les informations relatives à celle-ci*/
            catch(PDOException $e){
              echo "Erreur : " . $e->getMessage();
            }

            $conn = null;
        ?>
    </body>
</html>