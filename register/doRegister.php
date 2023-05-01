<?php
session_start();


if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    require_once "../context.php";

    $sqlMail = $context->prepare("select * from users where email = '$email'");
    $sqlMail->execute();
    $dataMail = $sqlMail->rowCount();

    $sqlPassword = $context->prepare("select * from users where password = '$pass'");
    $sqlPassword->execute();
    $dataPassword = $sqlPassword->rowCount();

    if ($dataMail > 0) {
        echo "Duplicated e-mail";
    } else if ($dataPassword > 0) {
        echo "Duplicated password";
    } else {
        try {
            $sql = "insert into users (name, email, password) values ('$name', '$email', '$pass')";
            $query = $context->prepare($sql);
            $result = $query->execute();
            $rs = $context->lastInsertId() or die(print_r($query->errorInfo(), true));

            $sql2 = "insert into users_in_environments (environmentId, userId) values (null, $rs)";
            $query2 = $context->prepare($sql2);
            $result2 = $query2->execute();

            echo json_encode($result2);
        } catch (PDOException $ex) {
            die("Erro: <code>" . $ex->getMessage() . "</code>");
        }
    }
}
