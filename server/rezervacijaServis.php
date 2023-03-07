<?php

class RezervacijaServis{

    private $broker;

    public function __construct($b){
        $this->broker=$b;
    }
    public function vratiSve(){
        return $this->broker->izvrsiCitanje("select r.*, kn.naziv as 'naziv', k.ime, k.prezime from rezervacija r inner join knjiga kn on (r.knjiga=kn.id) inner join korisnik k on (r.korisnik=k.id)");
    }
    public function kreiraj($knjigaId,$korisnikId){

       
        $knjiga=$this->broker->izvrsiCitanje("select * from knjiga where id=".$knjigaId)[0];
        $korisnik=$this->broker->izvrsiCitanje("select * from korisnik where id=".$korisnikId)[0];
      
        $query="insert into rezervacija(korisnik,knjiga) values (".$korisnikId.",".$knjigaId.")";
        $this->broker->izvrsiIzmenu($query);
    }

}

?>