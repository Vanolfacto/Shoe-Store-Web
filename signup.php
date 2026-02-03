<?php

// konekcija sa bazom
require_once "konekcija.php";
require_once "funkcije.php";

//preuzimanje podataka sa forme za sigunp i provera unetih podataka
$firstName = proveraPodataka(test_input($_POST['nFirstName']??""));
$lastName = proveraPodataka(test_input($_POST['nLastName']??""));
$email = filter_input(INPUT_POST,"nEmail",FILTER_VALIDATE_EMAIL);

// provera passworda po odredjenom sablonu i da li se lozinke poklapaju
$pass = proveraPass(test_input($_POST['nPass']??""));
$rePass = test_input($_POST['nRePass']??"");


if($pass != $rePass){
    alert("Sifre se nepoklapaju!");
}

// unos podataka i registracija korisnika
if(empty($firstName) || empty($lastName) || empty($email) || 
    empty($pass) || empty($rePass)){
        die("Nisu uneti svi potrebni podaci!!!");
    }
// kreiranje statementa
$stmt = $conn->prepare("INSERT INTO `korisnici` 
                (`idKorisnika`, `ime`, `prezime`, `email`, `sifra`, `privilegija`) 
    VALUES (NULL, ?, ?, ?, SHA1(?), 'Korisnik');");

// tipovi i podaci 
$stmt->bind_param("ssss",$firstName,$lastName,$email,$pass);

// izvrsavanje upita
$rez = $stmt->execute();
if($rez==false){
    die("Greska: ".$conn->error);
}
echo "Korisnik je uspesno registrovan!";