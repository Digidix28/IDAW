<?php
require_once("templates/template_header.php");

session_start();
if (isset($_SESSION['id']) == false) {
  header("Location: login.php");
  exit;
} else {
  $id = $_SESSION['id'];
}
?>

<body>
  <main>
    <header>
      <h1>Tableau de bord</h1>
      <h2>Sommaire des pages</h2>
      <?php
      require_once("templates/template_menu.php");
      renderMenuToHTML('dashboard');
      ?>
    </header>
    <h2> Mesurez ici vos consommations hebdomadaires des nutriments majeurs au bon développement de votre corps</h2>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title" id="card1_title">Energie (kJ/100 g)</h5>
              <p class="card-text" id="card1_text">Please wait while we retrieve the data.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title" id="card2_title">Protéines (g/100 g)</h5>
              <p class="card-text" id="card2_text">Please wait while we retrieve the data.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title" id="card3_title">Glucides (g/100 g)</h5>
              <p class="card-text" id="card3_text">Please wait while we retrieve the data.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title" id="card4_title">Lipides (g/100 g)</h5>
              <p class="card-text" id="card4_text">Please wait while we retrieve the data.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>

      var userId = <?php echo json_encode($id); ?>;

      $.ajax({

        type: 'GET',
        url: `http://localhost/IDAW/Projet/backend/API/dashboard.php?user_id=${userId}&id_nutriment=1`,
        dataType: 'json',

      }).always(function (response) {
        const hebdo = parseFloat(response.data['0'].hebdo).toFixed(2);
        $("#card1_text").text(hebdo);
      });

      $.ajax({

        type: 'GET',
        url: `http://localhost/IDAW/Projet/backend/API/dashboard.php?user_id=${userId}&id_nutriment=2`,
        dataType: 'json',

      }).always(function (response) {
        const hebdo = parseFloat(response.data['0'].hebdo).toFixed(2);
        $("#card2_text").text(hebdo);
      });

      $.ajax({

        type: 'GET',
        url: `http://localhost/IDAW/Projet/backend/API/dashboard.php?user_id=${userId}&id_nutriment=3`,
        dataType: 'json',

      }).always(function (response) {
        const hebdo = parseFloat(response.data['0'].hebdo).toFixed(2);
        $("#card3_text").text(hebdo);
      });

      $.ajax({

        type: 'GET',
        url: `http://localhost/IDAW/Projet/backend/API/dashboard.php?user_id=${userId}&id_nutriment=4`,
        dataType: 'json',

      }).always(function (response) {
        const hebdo = parseFloat(response.data['0'].hebdo).toFixed(2);
        $("#card4_text").text(hebdo);
      });


    </script>
  </main>
</body>

</html>