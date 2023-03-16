<?php
    $currentLanguage = "fr";
    if (isset($_GET['lang'])) {
        $currentLanguage = $_GET['lang'];
    }
    

    require_once("template_header.php");
    require_once("template_menu.php");
    // require_once("menu.php");
    $currentPageId = 'accueil';
    if (isset($_GET['page'])) {
        $currentPageId = $_GET['page'];
    }

    
?>
<!-- <header 
    class="bandeau_haut">
    <h1 class="titre">Idriss JEAIDI</h1>
</header> -->

<body id="page-top">
    <?php
        renderMenuToHTML($currentPageId, $currentLanguage)
    ?>

    <section class="corps">
        <?php
        $pageToInclude = "{$currentLanguage}/" . $currentPageId . ".php";
        if (is_readable($pageToInclude))
            require_once($pageToInclude);
        else
            require_once("error.php");
        ?>
    </section>
    <?php
    require_once("fr/footer_template.php");
    ?>

</body>

</html>