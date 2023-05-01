<?php
session_start();

if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    $environmentId = $_SESSION['environmentId'];

    require_once('../context.php');

    try {
        $sql = "update users_in_environments set environmentId = null where userId = $userId and environmentId = $environmentId";
        $query = $context->prepare($sql);
        $result = $query->execute();
        $rs = $context->lastInsertId() or die(print_r($query->errorInfo(), true));

        echo json_encode($result);
    } catch (PDOException $ex) {
        die("Erro: <code>" . $ex->getMessage() . "</code>");
    }
}
