<?php
session_start();

if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];

    require_once "../context.php";

    if (isset($_SESSION['environmentId'])) {
        $environmentId = $_SESSION['environmentId'];

        try {
            $sql = "update users_in_environments set environmentId = $environmentId where userId = $userId";
            $query = $context->prepare($sql);
            $result = $query->execute();
            $rs = $context->lastInsertId();

            echo json_encode($result);
        } catch (PDOException $ex) {
            die("Erro: <code>" . $ex->getMessage() . "</code>");
        }
    }
}
