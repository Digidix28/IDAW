<?php

function renderMenuToHTML($current_id){
    $myMenu = array(
        "index" => array("Accueil"),
        "aliments" => array("Aliments"),
        "journal" => array("Mon journal"),
        "profil" => array("Mon profil"),
        "dashboard" => array("Tableau de bord")
    );


    echo "<nav class = 'menu' >";

    foreach($myMenu as $pageId => $paramTab){
        
        if ($current_id == $pageId) {
            echo "<a class='selected' href = {$pageId}.php> {$paramTab[0]} </a>";
        }else{
            echo "<a href = {$pageId}.php> {$paramTab[0]} </a>";
        }
    };
    
    echo "</nav>";
}


?>
