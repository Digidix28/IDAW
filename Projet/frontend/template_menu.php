
<?php

function renderMenuToHTML($current_id){
    $myMenu = array(
        "index" => array("Acceuil"),
        "cv" => array("Mon CV"),
        "hobies" => array("Mes hobbies"),
        "infos_techniques" => array("Informations techniques")
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