<?php
session_start();

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    require_once "../context.php";

    $sql = "select * from users where email = '$email' and password = '$pass'";
    $result = $context->query($sql);
    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    if ($data != null) {
        foreach ($data as $line) {
            $_SESSION['loggedUser'] = true;
            $_SESSION['userId'] = $line['userId'];
            $_SESSION['userEmail'] = $line['email'];

            echo json_encode(true);
        }
    } else {
        echo json_encode(false);
    }
}
