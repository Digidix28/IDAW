<!doctype html>
<html lang="fr">

<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <?php
    require_once("templates/template_header.php")
        ?>
</head>

<body>
    <main>
        <header>
            <h1>Page d'indexation des aliments</h1>
            <h2>Sommaire des pages</h2>
            <?php
            require_once("templates/template_menu.php");
            renderMenuToHTML('cv');
            ?>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <form id="addStudentForm" action="" onsubmit="onFormSubmit();">
                        <div class="form-group">
                            <label for="inputNom">Nom</label>
                            <input type="text" class="form-control" id="inputNom">
                        </div>
                        <div class="form-group">
                            <label for="inputType">id_type</label>
                            <input type="email" class="form-control" id="inputType">
                        </div>
                        <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                    </form>
                </div>
                <div class="col-md-8">
                    <p> voici la liste des aliments présent dans notre base de données</p>
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">nom</th>
                                <th scope="col">id_type</th>
                                <th scope="col">CRUD</th>
                            </tr>
                        </thead>
                        <tbody id="AlimentsTableBody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>
            let dTable = $("#myTable").DataTable({
                ajax: {
                    url: "http://localhost/projet/IDAW/Projet/backend/API/aliments.php",
                    dataSrc: 'data'
                },
                columns: [
                    { data: 'id' },
                    { data: 'nom' },
                    { data: 'id_type' },
                    {
                        targets: -1,
                        data: null,
                        defaultContent: "<td><button class='editBtn'>Edit</button></td><td><button class='deleteBtn' onclick='onDelete()'>Delete</button></td>",
                    },
                ],
                createdRow: function (row, data, dataIndex) {
                    // Set the id of the edit button to the "id" key in the data
                    $(row).find('.editBtn').attr('id', data.id);
                    $(row).find('.deleteBtn').attr('id', data.id);
                }
            });

            id = 0;
            $('#myTable tbody').on('click', 'deleteBtn', function () {

                var id_btn = $(event.target).attr('id');
                var userData = {
                    'id': id_btn
                }
                $.ajax({
                    type: 'DELETE',
                    url: `http://localhost/projet/IDAW/Projet/backend/API/aliments.php?id=${id_btn}`,
                    dataType: 'json',
                }).done(function () {
                    dTable
                        .row($(this).parents('tr'))
                        .remove()
                        .draw();
                });
            });
            var rowGlob;
            var update = false;

            function onEdit(id) {
                // get the row using the id
                let row = $('#' + id);
                rowGlob = row;
                update = true;
                // get the values of the cells in the row
                let nom = row.find('td:eq(0)').text();
                let id_type = row.find('td:eq(1)').text();

                // populate the form with the row data
                // On met .val pour accéder à des valeurs, par exemple aux valeurs du formulaire. Le .text permet d'accéder au texte de la balise.
                $('#inputNom').val(nom);
                $('#inputType').val(id_type);

                // change the submit button to an update button
                $('#submitBtn').text('Update');
                // $('#addStudentForm').attr('onsubmit', 'onUpdate(${id});');
            }

            function onFormSubmit() {
                // prevent the form to be sent to the server
                event.preventDefault();

                var userData = {

                    name: $("#inputNom").val(),
                    email: $("#inputType").val(),

                };

                $.ajax({
                    type: "POST",
                    url: "http://localhost/projet/IDAW/Projet/backend/API/aliments.php",
                    data: userData,
                    dataType: 'json'

                }).done(function (response) {
                    dTable.row.add(userData).draw(false);
                });
            }
        </script>
    </main>
    <?php
    require_once("templates/footer_template.php")
        ?>
</body>

</html>