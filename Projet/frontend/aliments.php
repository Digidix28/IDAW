<?php
require_once("templates/template_header.php");
require_once("config.php");
?>

<body>
    <main>
        <header>
            <h1>Page d'indexation des aliments</h1>
            <h2>Sommaire des pages</h2>
            <?php
            require_once("templates/template_menu.php");
            renderMenuToHTML('aliments');
            ?>
        </header>
        <p> voici la liste des aliments présent dans notre base de donnes</p>
        <table class="table" id="myTable">
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
        <form id="addaliments" action="" onsubmit="onFormSubmit();">
            <div class="form-group row">
                <label for="inputHidden" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-3">
                    <input type="hidden" class="form-control" id="inputHidden">
                </div>
                <div class="form-group row">
                    <label for="inputNom" class="col-sm-2 col-form-label">Nom</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="inputNom">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputType" class="col-sm-2 col-form-label">id_type</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" id="inputType">
                    </div>
                </div>
                <span class="col-sm-2"></span>
                <div class="col-sm-2">
                    <button type="submit" id="submitBtn" class="btn btn-primary form-control">Submit</button>
                </div>
        </form>

        <script>
            let API_URL_BASE = "<?php echo $API_URL_BASE ?>";
            let dTable = $("#myTable").DataTable({
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
                        defaultContent: "<td><button class='editBtn'>Edit</button></td><td><button class='deleteBtn'>Delete</button></td>",
                    },
                ],
                createdRow: function (row, data, dataIndex) {
                    // Set the id of the edit button to the "id" key in the data
                    $(row).find('.editBtn').attr('id', data.id);
                    $(row).find('.deleteBtn').attr('id', data.id);
                }
            });
            edit = false;
            id = 0;
            $('#myTable tbody').on('click', '.deleteBtn', function (event) {
                var id_btn = $(event.target).attr('id');
                console.log(id_btn);
                var row = $(event.target);
                $.ajax({
                    type: 'DELETE',
                    url: API_URL_BASE + `/aliments.php?id=${id_btn}`,
                    dataType: 'json',
                }).always(function () {
                    dTable
                        .row($(row).parents('tr'))
                        .remove()
                        .draw();
                });
            });

            $('#myTable tbody').on('click', '.editBtn', function (event) {
                var id_aliment = $(event.target).attr('id');
                var row = $(event.target).parents('tr');
                let nom = row.find('td:eq(0)').text();
                let id_type = row.find('td:eq(1)').text();
                $('#inputNom').val(nom);
                $('#inputType').val(id_type);
                $('#inputHidden').val(id_aliment);
                $('#submitBtn').text('Update');
                // $('#addConsommationForm').attr('onsubmit', 'onUpdate(${id});');
                rowGlob = row;
                edit = true;
            });

            function onFormSubmit() {
                // prevent the form to be sent to the server
                event.preventDefault();
                if (edit == false) {
                    let nom = $("#inputNom").val();
                    let id_type = $("#inputType").val();
                    var alimentsData = {
                        nom: $("#inputNom").val(),
                        id_type: $("#inputType").val()
                    };
                    $.ajax({
                        type: "POST",
                        url: API_URL_BASE + '/aliments.php',
                        data: alimentsData,
                        dataType: 'json'
                    }).always(function (response) {
                        dTable.row.add(alimentsData).draw(false);
                    });
                } else {
                    
                    
                    var alimentsData = {
                        nom: $("#inputNom").val(),
                        id_type: $("#inputType").val(),
                        id: $("#inputHidden").val(),
                    };
                    $.ajax({
                        type: "PUT",
                        url: API_URL_BASE + '/aliments.php',
                        async: false,
                        method: "PUT",
                        dataType: "json",
                        data: JSON.stringify(alimentsData),
                    }).always(function (response) {
                        console.log(response);
                        dTable.row(rowGlob).data(response.data['0']).draw(false);
                    });
                }

            }
        </script>
    </main>
</body>

</html>