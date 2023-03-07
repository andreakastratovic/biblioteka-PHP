<?php
    include 'header.php';
?>

<div class='container mt-3'>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Naziv dela</th>
               
            </tr>
        </thead>
        <tbody id='knjige'>

        </tbody>
    </table>

    <div class="col-4">
            <h3 class="text-center" id='naslov'> dodaj knjigu</h3>
            <form id='forma'>
                <label>Naziv</label>
                <input class="form-control" type="text" id='naziv'>
               
                <button type="submit" class="btn btn-primary form-control mt-2">Sacuvaj</button>

            </form>
</div>

</div>

<script>

    $(document).ready(function () {
        $.getJSON('./server/index.php', { akcija: 'vratiKnjige' }, function (res) {
            if (!res.status) {
                alert(res.error);
                return;
            }
            for (let knjiga of res.data) {
                $('#knjige').append(`
                <tr>
                    <td>${knjiga.id}</td>
                    <td>${knjiga.naziv}</td>
                   
                </tr>
            `)
            }
        })
    })

</script>


<?php
    include 'footer.php';
?>