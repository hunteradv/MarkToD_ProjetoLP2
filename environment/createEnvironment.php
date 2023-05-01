<?php
session_start();

if (isset($_POST['name'])) {
    $name = $_POST['name'];

    require_once "../context.php";

    if (isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];


        try {
            $sql = "insert into environments (name, head) values ('$name', '$userId')";
            $query = $context->prepare($sql);
            $result = $query->execute();
            $rs = $context->lastInsertId();

            $lastId = $rs;

            $sql2 = "insert into users_in_environments (environmentId, userId) values ($lastId, $userId)";
            $query2 = $context->prepare($sql2);
            $result2 = $query2->execute();

            echo json_encode($result2);
        } catch (PDOException $ex) {
            die("Erro: <code>" . $ex->getMessage() . "</code>");
        }
    }
}
