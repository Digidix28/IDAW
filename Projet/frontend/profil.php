<?php
require_once("templates/template_header.php");
$id = 2;
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
        <h2>My Profil</h2>
        <div id="profil-form">
            <form>
                <h2>My Profil</h2>
                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" class="form-control" id="nom" name="nom">
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom :</label>
                    <input type="text" class="form-control" id="prenom" name="prenom">
                </div>
                <div class="form-group">
                    <label for="login">Email :</label>
                    <input type="email" class="form-control" id="login" name="login">
                </div>
                <div class="form-group">
                    <label for="sexe">Sexe :</label>
                    <select class="form-control" id="sexe" name="sexe">
                        <option value="0">Homme</option>
                        <option value="1">Femme</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="age">Âge :</label>
                    <input type="number" class="form-control" id="age" name="age">
                </div>
                <div class="form-group">
                    <label for="mdp">Mot de passe :</label>
                    <input type="password" class="form-control" id="mdp" name="mdp">
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </div>
    </main>
    <script>
        var userId = <?php echo json_encode($id); ?>;
        $(document).ready(function () {
            $.ajax({
                url: "http://localhost/projet/IDAW/Projet/backend/API/users.php",
                type: "GET",
                dataType: "json",
                data: {
                    id_user: userId,
                    fields: "nom,prenom,login,sexe,age,mdp"
                }
                // success: function (response) {
                //     var userData = response.data[0];
                //     console.log(userData.prenom)
                //     $('#nom').val(userData.nom);
                //     $('#prenom').val(userData.prenom);
                //     $('#login').val(userData.login);
                //     $('#sexe').val(userData.sexe);
                //     $('#age').val(userData.age);
                //     $('#mdp').val(userData.mdp);
                // },
                // error: function (xhr, status, error) {
                //     console.log(error);
                // }
            }).always(function (response) {
                var userData = response.data;
                    console.log(response)
                    // $('#nom').val(userData.nom);
                    // $('#prenom').val(userData.prenom);
                    // $('#login').val(userData.login);
                    // $('#sexe').val(userData.sexe);
                    // $('#age').val(userData.age);
                    // $('#mdp').val(userData.mdp);
               });
        });


    </script>
</body>

</html>