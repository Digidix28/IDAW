<?php
require_once("templates/template_header.php");
session_start();
// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

header("Location: login.php");
?>

<body>
    <header>
        <h1 class="page-title">Page d'accueil</h1>
    </header>
    <main>
        <p class="intro-paragraph">Bienvenue sur mon premier site web. Cette page a pour seule utilité de s'orienter vers les autres parties du site.</p>

        <h2 class="section-title">Sommaire des pages</h2>
        <?php
        require_once("templates/template_menu.php");
        renderMenuToHTML('index');
        ?>
    </main>
    <?php require_once("templates/footer_template.php"); ?>
</body>


</html>