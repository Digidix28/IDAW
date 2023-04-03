<?php
require_once("templates/template_header.php");
session_start();
if (isset($_SESSION['id']) == false) {
    header("Location: login.php");
    exit;
}else{
    $id = $_SESSION['id'];
}
?>

    <body>
        <main>
            <header>
                <h1>Présentation de mon CV</h1>
            </header>
            <p> Cette page est dédiée à mon CV. J'ai déjà trouvé un stage pour cette année donc ne me contactez pas</p>
            
            <h2>Sommaire des pages</h2>
                <?php
                    require_once("templates/template_menu.php");
                    renderMenuToHTML('cv');
                ?>

    </main>
    <?php
            require_once("templates/footer_template.php")
        ?>
    </body>
</html>