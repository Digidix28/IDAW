<?php
require_once("templates/template_header.php");
?>

<body>

    <div class="form-container">
        <form id="login-form" action="" onsubmit="onLogInFormSubmit();">
            <h2>Login</h2>
            <div class="form-group">
                <label for="login">Login :</label>
                <input type="email" id="loginMail" name="login" required>
            </div>
            <div class="form-group">
                <input type="password" id="logInpassword" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit"  name="login-submit">
            </div>
        </form>
        <form id="signup-form" action="" onsubmit="onSignUpFormSubmit();">
            <h2>Sign Up</h2>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="SignUpEmail" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="SignUpPassword" name="password" required>
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
                <input type="submit" value="S'inscrire..." name="signup-submit">
            </div>
        </form>
    </div>



    <script>
        let API_URL_BASE = "<?php echo $API_URL_BASE ?>";
        let WINDOW_URL_BASE = "<?php echo $WINDOW_URL_BASE ?>";
        function onSignUpFormSubmit() {

            event.preventDefault();

            var userData = {

                login: $("#SignUpEmail").val(),
                mdp: $("#SignUpPassword").val(),
                nom: $("#nom").val(),
                prenom: $("#prenom").val(),
                sexe: $("#sexe").val(),
                age: $("#age").val(),
                poids: $("#poids").val(),
            };

            console.dir(userData);

            $.ajax({

                type: "POST",
                url: API_URL_BASE + '/users.php',
                data: userData,
                dataType: 'json'

            }).done(function (response) {
                id_user = response.data.user_data.id_user;
                window.location.replace( WINDOW_URL_BASE + `/index.php?id=${userData.login}`);

            });
        }
        $(document).ready(function () {
            function onLogInFormSubmit(event) {
                // prevent the form to be sent to the server
                event.preventDefault();

                var userData = {

                    login: $("#loginMail").val(),
                    mdp: $("#logInpassword").val()
                };

                console.dir(userData);

                $.ajax({
                    type: "GET",
                    url: API_URL_BASE + '/users.php',
                    data: userData,
                    dataType: 'json'

                }).done(function (response) {

                    var isConnected = response.data.user_exists;
                    id_user = response.data.user_data.id_user;
                    console.log(isConnected);

                    if (isConnected) {
                        window.location.replace( WINDOW_URL_BASE + `/index.php?id=${id_user}`);

                    } else {
                        console.log("dans le else");

                    }
                });
            }
        });