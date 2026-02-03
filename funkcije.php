<?php

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


// funkcija za validaciju broja indeksa mora biti u sledecem formatu: 001/21
// trocifreni broj iskljucivo nakon kog sledi / i nakon toga godina upisa koja ne sme
// biti veca od 23

function proveraIndeks($indeks)
{
  if (preg_match('/^\d{2}[1-9]\/2[1-3]$/', $indeks) == false) {
    die("Broj indeksa nije validan format mora biti npr(001/21)!");
  }
}


// funkcija za validaciju ime, prezime
function proveraPodataka($podatak)
{
  if (preg_match('/^[A-Z]{1}[a-z]{2,29}$/', $podatak) == false) {
    die("Podatak mora sadrzati samo slova!!!");
  }
  return $podatak;
}

// password provera primenom regularnih izraza
function proveraPass($param){
  $prVelikaSlova =preg_match("/[A-Z]/", $param);
  $prMalaSlova = preg_match("/[a-z]/", $param);
  $prBrojke = preg_match("/[0-9]/",$param);
  $prSpecKarakteri = preg_match("/[^A-Z0-9a-z\s]/",$param);

  if(strlen($param)>7 && $prVelikaSlova && $prMalaSlova && $prBrojke && $prSpecKarakteri){
    return $param;
  }

  die("Sifra nije u odgovarajucem formatu, proverite unete karaktere!");
    
  
}