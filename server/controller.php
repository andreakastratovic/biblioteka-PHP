<?php
include "korisnikServis.php";
include "broker.php";
include "knjigaServis.php";
include "rezervacijaServis.php";

class Controller{

    private $korisnikServis;
    private $rezervacijaServis;
    private $knjigaServis;

    public function __construct(){
        $this->korisnikServis=new KorisnikServis(Broker::getBroker());
        $this->knjigaServis=new KnjigaServis(Broker::getBroker());
        $this->rezervacijaServis=new RezervacijaServis(Broker::getBroker());
    }

    public function izvrsi(){
        $akcija=($_SERVER['REQUEST_METHOD']=="POST")?$_POST["akcija"]:$_GET["akcija"];
        try {
           
            if($akcija=="vratiKorisnike"){
                return $this->vratiOdgovor($this->korisnikServis->vratiSve());
            }
            if($akcija=="vratiKnjige"){
                return $this->vratiOdgovor($this->knjigaServis->vratiSve());
            }
            if($akcija=="vratiRezervacije"){
                return $this->vratiOdgovor($this->rezervacijaServis->vratiSve());
            }
            if($akcija=='kreirajKorisnika'){
                $this->korisnikServis->kreiraj($_POST["ime"],$_POST["prezime"]);
                return  $this->vratiOdgovor(null);
            }
            if($akcija=='kreirajRezervaciju'){
                $this->rezervacijaServis->kreiraj($_POST["knjiga"],$_POST["korisnik"]);
                return  $this->vratiOdgovor(null);
            }
            if($akcija=='izmeniKorisnika'){
                $this->korisnikServis->izmeni($_POST['id'],$_POST["ime"],$_POST["prezime"]);
                return $this->vratiOdgovor(null);
            }
            if($akcija=='obrisiKorisnika'){
                $this->korisnikServis->obrisi($_POST['id']);
                return $this->vratiOdgovor(null);
            }
            return $this->vratiGresku("Metoda nije podrzana");
        } catch (Exception $ex) {
            return $this->vratiGresku($ex->getMessage());
        }
    }
     private function vratiOdgovor($podaci){
        if(!isset($podaci)){
            return[
                "status"=>true,
            ];
        }
        return[
            "status"=>true,
            "data"=>$podaci
        ];
    }
     private function vratiGresku($greska){
        return[
            "status"=>false,
            "error"=>$greska
        ];
    }
}

$controller=new Controller();

?>