
<?php

class KorisnikServis{

    private $broker;

    public function __construct($b){
        $this->broker=$b;
    }
    public function vratiSve(){
        return $this->broker->izvrsiCitanje("select * from korisnik");
    }
    public function kreiraj($ime,$prezime){
        $this->broker->izvrsiIzmenu("insert into korisnik(ime,prezime) values('".$ime."','".$prezime."')");
    }
    public function izmeni($id,$ime,$prezime){
         $this->broker->izvrsiIzmenu("update korisnik set ime='".$ime."', prezime='".$prezime."' where id=".$id);
    }
    public function obrisi($id){
        $this->broker->izvrsiIzmenu("delete from korisnik where id=".$id); 
    }
}

?>