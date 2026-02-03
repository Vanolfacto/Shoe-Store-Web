<?php

// pokretanje sesije
session_start();

// konekcija sa bazom
require_once "konekcija.php";
// funkcije
require_once "funkcije.php";

// preuzimanje podataka sa klijentske strane za logovanje
$email = filter_input(INPUT_POST, "nEmail", FILTER_VALIDATE_EMAIL);
$pass = test_input($_POST['nPass'] ?? "");

if (empty($email) || empty($pass)) {
    die("Niste uneli sve potrebne parametre");
}

// kreiranje statemen-a za selekciju podataka iz tabele korisnik
$stmt = $conn->prepare("SELECT * FROM `korisnik` WHERE `email`=? AND `sifra`=SHA1(?)");
$stmt->bind_param("ss", $email, $pass);
$provera = $stmt->execute();
// provera da li je upit uspesno izvrsen ili nije
if ($provera == false) {
    die("Greska:" . $conn->error);
}
$rez = $stmt->get_result(); // postavlja podatke u objekat object(mysqli_result)
// provera da li postoji zapis tj da li postoji korisnik u bazi
if ($rez->num_rows > 0) {
    $red = $rez->fetch_assoc(); //asocijativni niz kolona u db je kljuc a zapis je vrednost 
    $_SESSION['korisnik'] = $red['ime'];
    $_SESSION['email'] = $red['email'];
    $_SESSION['privilegija'] = $red['privilegija'];

    switch ($red['privilegija']) {
        case 'admin':
            header("Location:index.php");
            break;
        case 'moderator':
            header("Location:indexModerator.php");
            break;
        case 'korisnik':
            header("Location:indexKorisnik.php");
            break;

        default:
            header("Location:404.html");
            break;
    }
} else {
    echo "Takav korisnik ne postoji!";
}
