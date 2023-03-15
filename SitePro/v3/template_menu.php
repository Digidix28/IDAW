<?php

function renderMenuToHTML($current_id)
{
    $myMenu = array(
        "accueil" => array("Acceuil"),
        "cv" => array("Mon CV"),
        "hobies" => array("Mes hobbies"),
        "infos_techniques" => array("Informations techniques")
    );


    echo "<nav class = 'menu' >";

    foreach ($myMenu as $pageId => $paramTab) {

        if ($current_id == $pageId) {
            echo "<a class='selected' href = 'index.php?page={$pageId}'> {$paramTab[0]} </a>";
        } else {
            echo "<a href = 'index.php?page={$pageId}'> {$paramTab[0]} </a>";
        }
    }
    ;

    echo "</nav>";
}


?>