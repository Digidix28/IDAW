<?php
    require_once("template_header.php")
?>
    <body>
        <main>
            <header>
                <h1>Présentation de mes hobbies</h1>
            </header>
            <p> Cette page est dédiée à mes passions. J'aime le Hand, le Basket, le tennis de table et les jeux vidéos.</p>
            
            <h2>Sommaire des pages</h2>

            <div class="container">
                <?php
                    require_once("template_menu.php");
                    renderMenuToHTML('hobies');
                ?>
            </div>
        </main>
        <?php
            require_once("footer_template.php")
        ?>
    </body>
</html>