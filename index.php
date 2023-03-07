<?php
    include 'header.php';
?>

<div class="container mt-3">
    <h1 class="text-center">
        Rezervacije knjiga
    </h1>
    <div class="mt-2 mb-2">
        <input type="text" id='pretraga' placeholder="Pretrazi" class="form-control">
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Knjiga</th>
                <th>Korisnik</th>
        
            </tr>
        </thead>
        <tbody id='rezervacije'>

        </tbody>
    </table>
    <div>
        <h2>Kreiraj rezervaciju</h2>
        <form id='forma'>
            <label>Kredit</label>
            <select id="knjige" class="form-control"></select>
            <label>Korisnik</label>
            <select id="korisnik" class="form-control"></select>
           
            <button class="btn btn-primary" type="submit">Kreiraj</button>
        </form>
    </div>
</div>


<script>
    let rezervacije = [];

    $(document).ready(function () {
        ucitajRezervacije();
        ucitajKnjige();
        ucitajKorisnike();
        $('#pretraga').change(function () {
            popuniPodatke();
        })
        $('#forma').submit(function (e) {
            e.preventDefault();
            const knjiga = $("#knjige").val();
            const korisnik = $("#korisnik").val();
           
            $.post('./server/index.php', {
                akcija: 'kreirajRezervaciju',
                knjiga,
                korisnik
            }, function (res) {
                const parsed = JSON.parse(res);

                if (!parsed.status) {
                    alert(parsed.error);
                }
                ucitajRezervacije();
            })
        })
    })

    function ucitajRezervacije() {

        $.getJSON('./server/index.php', { akcija: 'vratiRezervacije' }, function (res) {
            if (!res.status) {
                alert(res.error);
                return;
            }
            rezervacije = res.data;
            popuniPodatke();
        })
    }
    function popuniPodatke() {
        const pretraga = $('#pretraga').val();
        const filtrirano = rezervacije.filter(function (rezervacija) {
            return rezervacija.ime.toLowerCase().includes(pretraga.toLowerCase()) ||
                rezervacija.prezime.toLowerCase().includes(pretraga.toLowerCase()) ||
                rezervacija.naziv.toLowerCase().includes(pretraga.toLowerCase())
        });
        $('#rezervacije').html('');
        for (let rezervacija of filtrirano) {
            $('#rezervacije').append(`
                <tr>
                    <td>${rezervacija.naziv}</td>
                    <td>${rezervacija.ime + ' ' + rezervacija.prezime}</td>
                    
                </tr>
            `)
        }

    }
    function ucitajKnjige() {
        $.getJSON('./server/index.php', { akcija: 'vratiKnjige' }, function (res) {
            if (!res.status) {
                alert(res.error);
                return;
            }
            for (let knjiga of res.data) {
                $('#knjige').append(`
                  <option value='${knjiga.id}'>
                    ${knjiga.naziv}
                </option>
                `)
            }
        })
    }
    function ucitajKorisnike() {
        $.getJSON("./server/index.php", { akcija: 'vratiKorisnike' }, function (res) {
            if (!res.status) {
                alert(res.error);
                return;
            }
            for (let korisnik of res.data) {
                $('#korisnik').append(`
                    <option value='${korisnik.id}'>${korisnik.ime + ' ' + korisnik.prezime}</option>
                `)
            }
        })
    }
</script>



<?php
    include 'footer.php';
?>