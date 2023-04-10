<?php
require_once("templates/template_header.php");
require_once("config.php");
session_start();

if (isset($_GET['id'])) {
    $_SESSION['id'] = $_GET['id'];
}

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
} else {
    header("Location: login.php");
    exit;
}



?>

<body>
    <main>
        <header class="header">
            <h1 class="header__title">Tableau de bord</h1>
            <nav class="header__nav">
                <h2 class="header__subtitle">Sommaire des pages</h2>
                <?php
                require_once("templates/template_menu.php");
                renderMenuToHTML('dashboard');
                ?>
            </nav>
        </header>
        <section class="dashboard">
            <h2 class="dashboard__subtitle">Mesurez ici vos consommations hebdomadaires des nutriments majeurs au bon
                développement de votre corps</h2>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title" id="card1_title">Energie (kJ)</h3>
                                <p class="card-text" id="card1_text">Récupération des données...</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title" id="card2_title">Protéines (g)</h3>
                                <p class="card-text" id="card2_text">Récupération des données...</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title" id="card3_title">Glucides (g)</h3>
                                <p class="card-text" id="card3_text">Récupération des données...</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title" id="card4_title">Lipides (g)</h3>
                                <p class="card-text" id="card4_text">Récupération des données...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
        let API_URL_BASE = "<?php echo $API_URL_BASE ?>";
    
        var userId = <?php echo json_encode($id); ?>;

            $.ajax({

                type: 'GET',
                url: API_URL_BASE + `/dashboard.php?user_id=${userId}&id_nutriment=1`,
                dataType: 'json',

            }).always(function (response) {
                const hebdo = parseFloat(response.data['0'].hebdo).toFixed(2);
                $("#card1_text").text(hebdo);
            });

            $.ajax({

                type: 'GET',
                url: API_URL_BASE + `/dashboard.php?user_id=${userId}&id_nutriment=2`,
                dataType: 'json',

            }).always(function (response) {
                const hebdo = parseFloat(response.data['0'].hebdo).toFixed(2);
                $("#card2_text").text(hebdo);
            });

            $.ajax({

                type: 'GET',
                url: API_URL_BASE + `/dashboard.php?user_id=${userId}&id_nutriment=3`,
                dataType: 'json',

            }).always(function (response) {
                const hebdo = parseFloat(response.data['0'].hebdo).toFixed(2);
                $("#card3_text").text(hebdo);
            });

            $.ajax({

                type: 'GET',
                url: API_URL_BASE + `/dashboard.php?user_id=${userId}&id_nutriment=4`,
                dataType: 'json',

            }).always(function (response) {
                const hebdo = parseFloat(response.data['0'].hebdo).toFixed(2);
                $("#card4_text").text(hebdo);
            });


        </script>
    </main>
</body>

</html>