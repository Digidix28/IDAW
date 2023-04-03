<?php
require_once("templates/template_header.php");
?>

<body>

    <div class="form-container">
        <form id="login-form" action="" onsubmit="onLogInFormSubmit();">
            <h2>Login</h2>
            <div class="form-group">
                <label for="login">Login :</label>
                <input type="text" id="login" name="login" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Se connecter...">
            </div>
        </form>

        <form id="signup-form" action="" onsubmit="onSignUpFormSubmit();">
            <h2>Sign Up</h2>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
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
                <label for="poids">Poids :</label>
                <input type="number" id="poids" name="poids" required>
            </div>
            <div class="form-group">
                <input type="submit" value="S'inscrire...">
            </div>
        </form>
    </div>



    <script>

        function onSignUpFormSubmit() {
            // prevent the form to be sent to the server
            event.preventDefault();

            var userData = {

                email: $("#inputMail").val(),
                mdp: $("#inputNom").val()


            };

            $.ajax({
                type: "POST",
                url: "http://localhost/IDAW/Projet/backend/API/users.php",
                data: userData,
                dataType: 'json'

            }).done(function (response) {
                dTable.row.add(userData).draw(false);
            });
        }

        function onLogInFormSubmit() {
            // prevent the form to be sent to the server
            event.preventDefault();

            var userData = {

                email: $("#inputMail").val(),
                mdp: $("#inputNom").val()


            };

            $.ajax({
                type: "GET",
                url: "http://localhost/IDAW/Projet/backend/API/users.php",
                data: userData,
                dataType: 'json'

            }).done(function (response) {
                dTable.row.add(userData).draw(false);
            });
        }



    </script>

</body>

</html>