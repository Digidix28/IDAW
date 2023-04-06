<?php
require_once("templates/template_header.php");
session_start();
if (isset($_GET['id'])) {
    $_SESSION['id'] = $_GET['id'];

} else {
    header("Location: login.php");
}
?>


<body>
    <main>
        <header>
            <h1>Page d'accueil</h1>
        </header>
        <p> Bienvenue sur mon premier site web. Cette page a pour seule utilité de s'orienter vers les autres parties du
            site</p>

        <h2>Sommaire des pages</h2>
        <div class="container colonne">
            <?php
            require_once("templates/template_menu.php");
            renderMenuToHTML('index');
            ?>
        </div>
    </main>
    <?php require_once("templates/footer_template.php"); ?>
</body>

</html>