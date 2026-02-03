<?php

session_start();

// unsetovanje svih varijabli sesije
session_unset();

// unistavanje sesije
session_destroy();

header("Location:prijava.html");