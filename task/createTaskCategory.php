<?php
session_start();

if (isset($_POST['name'])) {
    $name = $_POST['name'];
   

    require_once "../context.php";

    if (isset($_SESSION['userId']) || isset($_SESSION['environmentId'])) {
        $userId = $_SESSION['userId'];
        $environmentId = $_SESSION['environmentId'];

        try {
            $sql = "insert into taskcategories (name) values ('$name')";
            $query = $context->prepare($sql);
            $result = $query->execute();
            $rs = $context->lastInsertId() or die(print_r($query->errorInfo(), true));

            echo json_encode($result);
        } catch (PDOException $ex) {
            die("Erro: <code>" . $ex->getMessage() . "</code>");
        }
    }
}
