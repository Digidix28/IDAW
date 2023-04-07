<?php
require_once("templates/template_header.php");
?>

<body>
    <main>
        <header>
            <h1>Page d'accueil</h1>
            <h2>Sommaire des pages</h2>
            <?php
            require_once("templates/template_menu.php");
            renderMenuToHTML('infos_techniques');
            ?>
        </header>
        <p> bienvenue sur votre page de profil </p>

        <form id="profil-form" action="" onsubmit="onSignUpFormSubmit();">
            <h2>My Profil</h2>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="login" name="login" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="mdp" name="mdp" required>
            </div>
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="sexe">Sexe :</label>
                <input type="number" id="sexe" name="sexe" required>
            </div>
            <div class="form-group">
                <label for="age">Age :</label>
                <input type="number" id="age" name="age" required>
            </div>
            <div class="form-group">
                <label for="poid">Poids :</label>
                <input type="number" id="poid" name="poid" required>
            </div>
            <div class="form-group">
                <input type="submit" value="modifier">
            </div>
        </form>
        </div>
    </main>
    <script>
        $.ajax({
            url: "http://localhost/projet/IDAW/Projet/backend/API/users.php",
            type: "GET",
            data: {
                user_id: "2", // Replace with the actual user ID you want to retrieve
                fields: "login,nom,prenom,sexe,age,mdp" // Specify the fields you want to retrieve, separated by commas
            },
            success: function (response) {
                console.log(response.data.user_data); // The retrieved user data will be available in the user_data object
            },
            error: function (xhr, status, error) {
                console.log(error); // Log any errors to the console
            }
        });
    </script>
</body>

</html>