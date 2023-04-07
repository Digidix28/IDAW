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
            <h1>Journal de consommation</h1>
            <div class="container">
                <?php
                require_once("templates/template_menu.php");
                renderMenuToHTML('hobies');
                ?>
            </div>
        </header>
        <h3> Inscrivez ce que vous consommez, afin de tenir un journal des plats que vous avez consommés</h3>
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Plat</th>
                    <th scope="col">Quantité consommé (en g)</th>
                    <th scope="col">Date de consommation</th>
                    <th scope="col">CRUD</th>
                </tr>
            </thead>
            <tbody id="consommationTableBody">
            </tbody>
        </table>
        <h3> Ajoutez vos consommations journalières en cliquant sur l'aliment que vous avez mangé</h3>
        <table class="table" id="myTable2">
            <thead>
                <tr>
                    <th scope="col">nom</th>
                    <th scope="col">id_type</th>
                    <th scope="col">CRUD</th>
                </tr>
            </thead>
            <tbody id="AlimentsTableBody">
            </tbody>
        </table>
        <form id="addConsommationForm" action="" onsubmit="onFormSubmit();">
            <div class="form-group row">
                <label for="inputHidden" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-3">
                    <input type="hidden" class="form-control" id="inputHidden">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputAliment" class="col-sm-2 col-form-label">Aliment</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="inputAliment">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputQuantite" class="col-sm-2 col-form-label">Quantité</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="inputQuantite">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputDate" class="col-sm-2 col-form-label">Date de consommation</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" id="inputDate">
                </div>
            </div>
            <div class="form-group row">
                <span class="col-sm-2"></span>
                <div class="col-sm-2">
                    <button type="submit" id="submitBtn" class="btn btn-primary form-control">Submit</button>
                </div>
            </div>
        </form>

        <script>

            // $(document).ready(function () {
                // Your existing code here
                var userId = <?php echo json_encode($id); ?>;
                console.log(userId);

                let dTable = $("#myTable").DataTable({
                    ajax: {
                        type: 'GET',
                        url: `http://localhost/IDAW/Projet/backend/API/consommation.php?user_id=31`,
                        dataSrc: 'data'
                    },
                    columns: [
                        { data: 'nom' },
                        { data: 'quantité' },
                        { data: 'date_consommation' },
                        {
                            targets: -1,
                            data: null,
                            defaultContent: "<td><button class='editBtn'>Edit</button></td><td><button class='deleteBtn'>Delete</button></td>",
                        },
                    ],
                    createdRow: function (row, data, dataIndex) {
                        // Set the id of the edit button to the "id" key in the data
                        $(row).find('.editBtn').attr('id', data.id_consomme);
                        $(row).find('.deleteBtn').attr('id', data.id_consomme);
                    }

                });



                $('#myTable tbody').on('click', '.deleteBtn', function (event) {

                    var id_btn = $(event.target).attr('id');
                    var row = $(event.target)
                    $.ajax({
                        type: 'DELETE',
                        url: `http://localhost/IDAW/Projet/backend/API/consommation.php?id_consomme=${id_btn}`,
                        dataType: 'json',
                    }).always(function (response) {
                        console.log("on est entré dans le done");
                        dTable.row($(row).parents('tr')).remove().draw(true);
                        console.log("on est à la fin du done");
                    })

                });



                var rowGlob;
                var update = false;

                function onEdit() {
                    // get the row using the id
                    var id_btn = $(event.target).attr('id');
                    var row = $(event.target).parents("tr")
                    update = true;
                    // get the values of the cells in the row
                    let aliment = row.find('td:eq(0)').text();
                    let quantite = row.find('td:eq(1)').text();
                    let date = row.find('td:eq(2)').text();


                    // populate the form with the row data
                    // On met .val pour accéder à des valeurs, par exemple aux valeurs du formulaire. Le .text permet d'accéder au texte de la balise.
                    $('#inputAliment').val(nom);
                    $('#inputQuantite').val(prenom);
                    $('#inputDate').val(date);

                    // change the submit button to an update button
                    $('#submitBtn').text('Update');
                    // $('#addConsommationForm').attr('onsubmit', 'onUpdate(${id});');
                }

                function onFormSubmit() {
                    // prevent the form to be sent to the server
                    event.preventDefault();

                    var userData = {
                        aliment_id: $("#inputHidden").val(),
                        user_id: userId,
                        quantite: $("#inputQuantite").val(),
                        date_consommation: $("#inputDate").val(),

                    };
                    console.log(userData);

                    $.ajax({
                        type: "POST",
                        url: "http://localhost/IDAW/Projet/backend/API/consommation.php",
                        data: userData,
                        dataType: 'json'

                    }).always(function (response) {
                        dTable.row.add(userData).draw();
                    });
                }




                // Gestion de la dataTable des aliments ///////////////////////////////////////////////////////

                let dTable2 = $("#myTable2").DataTable({
                    ajax: {
                        url: "http://localhost/IDAW/Projet/backend/API/aliments.php",
                        dataSrc: 'data'
                    },
                    columns: [
                        { data: 'nom' },
                        { data: 'id_type' },
                        {
                            targets: -1,
                            data: null,
                            defaultContent: "<td><button class='consommeBtn'>Consommer</button></td>",
                        },
                    ],
                    createdRow: function (row, data, dataIndex) {
                        // Set the id of the edit button to the "id" key in the data
                        $(row).find('.consommeBtn').attr('id', data.id);
                    }
                });

                $('#myTable2 tbody').on('click', '.consommeBtn', function (event) {

                    var id_aliment = $(event.target).attr('id');
                    var row = $(event.target).parents('tr')

                    let aliment = row.find('td:eq(0)').text();

                    console.log("on est entré dans la fonction")
                    console.log(id_aliment)

                    $('#inputAliment').val(aliment);
                    $('#inputHidden').val(id_aliment);

                });
            // });
        </script>


    </main>
    <?php
    // require_once("templates/footer_template.php")
    ?>
</body>

</html>