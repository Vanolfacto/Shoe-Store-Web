<?php

require_once "konekcija.php";
require_once "funkcije.php";
$ime = proveraPodataka(test_input($_POST['kime']??""));
$prezime = proveraPodataka(test_input($_POST['kprezime']??""));
$email = filter_input(INPUT_POST,"kmail",FILTER_VALIDATE_EMAIL);
$brkart=proveraPodataka(test_input($_POST['kbrkart']??""));
$cvv=proveraIndeks(test_input($_POST['kcvv']??""));
$posta=proveraIndeks(test_input($_POST['kposta']??""));
$brtel=proveraPodataka(test_input($_POST['kbrtel']??""));
$adresa=proveraPodataka(test_input($_POST['kadresa']??""));

if(empty($ime) || empty($prezime) || empty($email) || 
    empty($brkart) || empty($cvv) || empty($posta) || empty($brtel) || empty($adresa)){
        alert("Nisu uneti svi podaci!");
    }
   

    $stmt = $conn->prepare("INSERT INTO `kor` 
                (`Ime`, `Prezime`, `Adresa`, `Broj Kartice`, `CVV`, `Postanski_broj`, `Broj telefona`, `E-mail`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?);");

$stmt->bind_param("ssssssss",$ime,$prezime,$adresa,$brkart, $cvv, $posta, $brtel);

$rez = $stmt->execute();
if($rez==false){
    die("Greska: ".$conn->error);
}

?>