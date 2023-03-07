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

<script>
    let korisnici = [];
    let trenutniId = 0;
    $(document).ready(function () {

        ucitajKorisnike();
        $('#obrisi').click(function () {
            obrisiKorisnika(trenutniId);
        })
        $('#forma').submit(function (e) {
            e.preventDefault();

            const ime = $("#ime").val();
            const prezime = $("#prezime").val();
            
            $.post('./server/index.php', {
                akcija: trenutniId === 0 ? 'kreirajKorisnika' : 'izmeniKorisnika',
                ime,
                prezime,
               
                id: trenutniId || undefined
            }, function (res) {
                res = JSON.parse(res);
                if (!res.status) {
                    alert(res.error);
                }
                popuniFormu(0);
                ucitajKorisnike();
            })
        })
        $("#vratiSe").click(function () {

            popuniFormu(0);
        })

    })

    function obrisiKorisnika(id) {
        $.post('./server/index.php', { akcija: 'obrisiKorisnika', id }, function (res) {
            res = JSON.parse(res);
            if (!res.status) {
                alert(res.error);
            }
            popuniFormu(0);
            ucitajKorisnike();
        })
    }

    function ucitajKorisnike() {
        $.getJSON("./server/index.php", { akcija: 'vratiKorisnike' }, function (res) {
            if (!res.status) {
                alert(res.error);
                return;
            }
            korisnici = res.data;
            $('#korisnici').html('');
            for (let korisnik of res.data) {
                $('#korisnici').append(`
                    <tr>
                        <td>${korisnik.id}</td>
                        <td>${korisnik.ime}</td>
                        <td>${korisnik.prezime}</td>
                       
                        <td>
                            <button onClick="popuniFormu(${korisnik.id})" class='btn btn-success width-100'>Detalji</button>
                        </td>
                    </tr>
                `)
            }
        })
    }
    function popuniFormu(id) {
        trenutniId = id;
        const korisnik = korisnici.find(e => e.id == id);
        $('#naslov').html(korisnik ? 'Izmeni korisnika' : 'Kreiraj korisnika');
        $('#ime').val(korisnik?.ime || '');
        $('#prezime').val(korisnik?.prezime || '');
       
        $("#obrisi").attr('hidden', korisnik === undefined);
        $("#vratiSe").attr('hidden', korisnik === undefined);
    }
</script>

<?php
    include 'footer.php';
?>

