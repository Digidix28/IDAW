<?php

function renderMenuToHTML($current_id,$currentLanguage)
{
    $myMenu = array(
        "accueil" => array("Acceuil","HomePage"),
        "cv" => array("Mon CV","My resume"),
        "hobies" => array("Mes hobbies", "my hobbies"),
        "infos_techniques" => array("Informations techniques","technical informations")
    );

    $myLanguages = array(
        "fr" => array('Français', "French"),
        "eng" => array("Anglais", "English")
    );

    echo "<nav class='navbar navbar-expand-lg navbar-dark fixed-top' id='mainNav'>
            <div class='container'>
                <a class='navbar-brand' href='#page-top'><img src='assets/img/navbar-logo.svg' alt='...' /></a>
                <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarResponsive' aria-controls='navbarResponsive' aria-expanded='false' aria-label='Toggle navigation'>
                    Menu
                    <i class='fas fa-bars ms-1'></i>
                </button>
                <div class='collapse navbar-collapse' id='navbarResponsive'>
                    <ul class='navbar-nav text-uppercase ms-auto py-4 py-lg-0'>";

    foreach ($myMenu as $pageId => $paramTab) {

        if ($currentLanguage == "fr") {
            echo "<li class='nav-item'><a class='nav-link' href = 'index.php?page={$pageId}&lang={$currentLanguage}'> {$paramTab[0]} </a></li>";
        } else {
            echo "<li class='nav-item'><a class='nav-link' href = 'index.php?page={$pageId}&lang={$currentLanguage}'> {$paramTab[1]} </a></li>";
        }
    }
    ;

    foreach ($myLanguages as $language => $paramTab) {

        if ($currentLanguage == "fr") {
            echo "<li class='nav-item'><a class='nav-link' href = 'index.php?page={$current_id}&lang={$language}'> {$paramTab[0]} </a></li>";
        } else {
            echo "<li class='nav-item'><a class='nav-link' href = 'index.php?page={$current_id}&lang={$language}'> {$paramTab[1]} </a></li>";
        }
    }
    ;

    echo "</ul>
    </div>
</div>
</nav>";
}


?>


        <!-- Navigation-->
        <!-- <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="assets/img/navbar-logo.svg" alt="..." /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#team">Team</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav> -->