<?php
    require_once("template_header.php")
?>
  <body>
    <main> 
        <header>
            <h1>Page d'accueil</h1>
        </header>
        <p> Bienvenue sur mon premier site web. Cette oage a pour seule utilité de s'orienté vers les autres parties du site</p>

        <h2>Sommaire des pages</h2>
        <div class="container colonne">
            <?php
                require_once("template_menu.php");
                renderMenuToHTML('index');

            ?>
        </div>
    </main>
        <?php
            require_once("footer_template.php")
        ?>
  </body>
</html>


