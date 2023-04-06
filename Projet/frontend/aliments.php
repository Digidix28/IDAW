<!doctype html>
<html lang="fr">

<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <?php
    require_once("templates/template_header.php")
        ?>
</head>

<body>
    <main>
        <header>
            <h1>Page d'indexation des aliments</h1>
            <h2>Sommaire des pages</h2>
            <div class="container colonne">
                <img src="images/cv_img.jpg" alt="CV" style=" width: 150px;">
                <?php
                    require_once("templates/template_menu.php");
                    renderMenuToHTML('cv');
                ?>
            </div>

    </main>
    <?php
    require_once("templates/footer_template.php")
        ?>
</body>

</html>