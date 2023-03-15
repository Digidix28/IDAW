<main>
    <header>
        <h1>Présentation de mon CV</h1>
    </header>
    <p> Cette page est dédiée à mon CV. J'ai déjà trouvé un stage pour cette année donc ne me contactez pas</p>

    <h2>Sommaire des pages</h2>
    <div class="container colonne">
        <img src="images/cv_img.jpg" alt="CV" style=" width: 150px;">
        <?php
        require_once("template_menu.php");
        renderMenuToHTML('cv');
        ?>
    </div>

</main>