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





<?php
    include 'footer.php';
?>