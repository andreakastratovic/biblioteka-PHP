<?php
    include 'header.php';
?>

<div class='container mt-2'>

    <div>
        <h1 class="text-center">
            Korisnici biblioteke
        </h1>
    </div>
    <div class="row mt-2">
        <div class="col-8">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Vidi</th>
                    </tr>
                </thead>
                <tbody id='korisnici'>

                </tbody>
            </table>
        </div>
        <div class="col-4">
            <h3 class="text-center" id='naslov'> Kreiraj korisnika</h3>
            <form id='forma'>
                <label>Ime</label>
                <input class="form-control" type="text" id='ime'>
                <label>Prezime</label>
                <input class="form-control" type="text" id='prezime'>
                <button type="submit" class="btn btn-primary form-control mt-2">Sacuvaj</button>

            </form>
            <button id="obrisi" hidden class="btn btn-danger form-control mt-2">Obrisi</button>
            <button hidden id='vratiSe' class="btn btn-secondary form-control mt-2">Vrati se na
                kreiranje</button>
        </div>
    </div>
</div>


<?php
    include 'footer.php';
?>

