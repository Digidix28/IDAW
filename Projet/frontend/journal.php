<?php
require_once("templates/template_header.php");
require_once("config.php");
session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];


} else {
    header("Location: login.php");
}
?>

<body>
    <main>
        <header>
            <h1>Journal de consommation</h1>
            <?php
            require_once("templates/template_menu.php");
            renderMenuToHTML('journal');
            ?>
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
                    <button type="submit" id="submitBtn" class="btn btn-primary form-control">Ajouter</button>
                </div>
            </div>
        </form>

        <script>

            let API_URL_BASE = "<?php echo $API_URL_BASE ?>";
            // $(document).ready(function () {

            var userId = <?php echo json_encode($id); ?>;
            let dTable = $("#myTable").DataTable({
                ajax: {
                    type: 'GET',
                    url: API_URL_BASE + `/consommation.php?user_id=` + userId,
                    dataSrc: 'data'
                },
                columns: [
                    { data: 'nom' },
                    { data: 'quantité' },
                    { data: 'date_consommation' },
                    {
                        targets: -1,
                        data: null,
                        defaultContent: "<td><button class='editBtn' >Edit</button></td><td><button class='deleteBtn'>Delete</button></td>",
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
                    url: API_URL_BASE + `/consommation.php?id_consomme=${id_btn}`,
                    dataType: 'json',
                }).always(function (response) {
                    dTable.row($(row).parents('tr')).remove().draw(true);
                })

            });



            var rowGlob;
            var update = false;

            $('#myTable tbody').on('click', '.editBtn', function (event) {
                // get the row using the id
                var id_consomme = $(event.target).attr('id');
                var row = $(event.target).parents("tr")
                update = true;
                // get the values of the cells in the row
                let aliment = row.find('td:eq(0)').text();
                let quantite = row.find('td:eq(1)').text();
                let date = row.find('td:eq(2)').text();

                console.log("on est entré dans le edit")
                // populate the form with the row data
                // On met .val pour accéder à des valeurs, par exemple aux valeurs du formulaire. Le .text permet d'accéder au texte de la balise.
                $('#inputAliment').val(aliment);
                $('#inputQuantite').val(quantite);
                $('#inputDate').val(date);
                $('#inputHidden').val(id_consomme);

                // change the submit button to an update button
                $('#submitBtn').text('Update');
                document.getElementById("addConsommationForm").scrollIntoView({ behavior: "smooth" });
                rowGlob = row;
            });

            function onFormSubmit() {
                // prevent the form to be sent to the server
                event.preventDefault();

                if (update) {
                    var userData = {

                        id_consomme: $("#inputHidden").val(),
                        quantite: $("#inputQuantite").val(),
                        date_consommation: $("#inputDate").val(),

                    };
                    console.log(userData);

                    $.ajax({
                        type: "PUT",
                        url: API_URL_BASE + '/consommation.php',
                        async: false,
                        method: "PUT",
                        dataType: "json",
                        data: JSON.stringify(userData),

                    }).always(function (response) {
                        dTable.row(rowGlob).data(response.data).draw(false);

                    });
                    $('#submitBtn').text('Ajouter');
                 


                } else {
                    var userData = {
                        aliment_id: $("#inputHidden").val(),
                        user_id: userId,
                        quantite: $("#inputQuantite").val(),
                        date_consommation: $("#inputDate").val(),

                    };

                    $.ajax({
                        type: "POST",
                        url: API_URL_BASE + '/consommation.php',
                        data: userData,
                        dataType: 'json'

                    }).always(function (response) {
                        dTable.row.add(response.data).draw(false);
                    });
                }


            }



            // Gestion de la dataTable des aliments ///////////////////////////////////////////////////////

            let dTable2 = $("#myTable2").DataTable({
                ajax: {
                    url: API_URL_BASE + '/aliments.php',
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

                $('#inputAliment').val(aliment);
                $('#inputHidden').val(id_aliment);

            });
        </script>


    </main>
</body>

</html>