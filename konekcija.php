<?php


/***************** KONEKCIJA SA DB SERVEROM ******************/
$host = "127.0.0.1:3309";
$user = "root";
$pass = "";
$db = "korisnik";

// kreiranje objekta konekcije
@$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Greska" . $conn->connect_error);
}
echo "Konekcija sa db serverom je uspesna!";