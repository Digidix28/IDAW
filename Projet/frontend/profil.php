<?php
require_once("templates/template_header.php");
require_once("config.php");
session_start();
if (isset($_GET['id'])) {
    $_SESSION['id'] = $_GET['id'];

} else {
    header("Location: login.php");
}
?>
<body>
    <main>
        <header>
            <h1>Page d'accueil</h1>
            <h2>Sommaire des pages</h2>
            <?php
            require_once("templates/template_menu.php");
            renderMenuToHTML('profil');
            ?>
        </header>
        <p> bienvenue sur votre page de profil </p>

        <form id="profil-form" action="" onsubmit="onSubmit();">
            <h2>My Profil</h2>
            <div class="form-group row">
                <label for="inputHidden" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-3">
                    <input type="hidden" class="form-control" id="inputHidden">
                </div>
            </div>
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
                <input type="number" id="poids" name="poids" required>
            </div>
            <div class="form-group">
                <input type="submit" value="modifier">
            </div>
        </form>

        </div>
    </main>
    <script>
        let API_URL_BASE = "<?php echo $API_URL_BASE ?>";
        var userId = <?php echo json_encode($id); ?>;
        $.ajax({
            type: "GET",
            url: API_URL_BASE + `/users.php?id_user=${userId}`,
            method: "GET",

        }).done(function (response) {
            console.log(response);
            $("#inputHidden").val(userId);
            $("#login").val(response.data['0'].login);
            $("#mdp").val(response.data['0'].mdp);
            $("#nom").val(response.data['0'].nom);
            $("#prenom").val(response.data['0'].prenom);
            $("#sexe").val(response.data['0'].sexe);
            $("#age").val(response.data['0'].age);
            $("#poids").val(response.data['0'].poid);
        });

        function onSubmit() {
            event.preventDefault();
            var userData = {
                id_user: $("#inputHidden").val(),
                login: $("#login").val(),
                mdp: $("#mdp").val(),
                nom: $("#nom").val(),
                prenom: $("#prenom").val(),
                sexe: $("#sexe").val(),
                age: $("#age").val(),
                poid: $("#poids").val(),
            };

            console.log(userData);

            $.ajax({
                type: "PUT",
                url: API_URL_BASE + '/users.php',
                async: false,
                method: "PUT",
                dataType: "json",
                data: JSON.stringify(userData),

            }).always(function (response) {
                
                $("#inputHidden").val(userId);
                $("#login").val(userData.login);
                $("#mdp").val(userData.mdp);
                $("#nom").val(userData.nom);
                $("#prenom").val(userData.prenom);
                $("#sexe").val(userData.sexe);
                $("#age").val(userData.age);
                $("#poids").val(userData.poid);
            });
        }
    </script>
</body>

</html>