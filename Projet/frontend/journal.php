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
                <h1>Journal de consommation</h1>
            </header>
            <p> Inscrivez ce que vous consommez, afin de tenir un journal des plats que vous avez consommés</h2>

            <div class="container">
                <?php
                    require_once("templates/template_menu.php");
                    renderMenuToHTML('hobies');
                ?>
            </div>
        </main>
        <?php
            require_once("templates/footer_template.php")
        ?>
    </body>
</html>