<?php
session_start();

if (isset($_SESSION['loggedUser']) || $_SESSION['loggedUser'] === true) {
    $_SESSION['loggedUser'] = false;

    echo json_encode(true);
} else {
    echo json_encode(false);
}
