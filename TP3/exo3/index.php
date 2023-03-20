<!DOCTYPE html>

<html>
    <?php
    $_params = $_GET;

    $style = "blue";
    
    if(isset($_COOKIE['style'])){
        $style = $_COOKIE['style'];
    }

    if(isset($_params['css'])){
        $style = $_params['css'];
        setcookie("style",$style);
    }


    

    ?>

    <head>
        <?php
        echo "<link href='${style}.css' rel='stylesheet' />";
        ?>
    </head>
    <body>
            <form id="style_form" action="index.php" method="GET">
        <select name="css">
            <option value="blue">bleu</option>
            <option value="red">rouge</option>
        </select>
        <input type="submit" value="Appliquer" />
    </form>
    <h1>vérifiez la couleur du texte</h1>
    </body>
</html>

