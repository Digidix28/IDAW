<footer >
        <p>Copyright 2023 Mon site web</p>
        <?php
            // set the default timezone to use.
            date_default_timezone_set('Europe/Paris');

            echo ("<p>" . date("h:i:s A") . "</p>");
        ?>
    </footer>