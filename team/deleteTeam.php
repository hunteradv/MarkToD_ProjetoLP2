<?php
session_start();

if (isset($_POST['teamId'])) {
    $id = $_POST['teamId'];

    require_once('../context.php');

    try {
        $sql = "delete from teams where teamId = $id";
        $query = $context->prepare($sql);
        $result = $query->execute();
        $rs = $context->lastInsertId() or die(print_r($query->errorInfo(), true));

        echo json_encode($result);
    } catch (PDOException $ex) {
        die("Erro: <code>" . $ex->getMessage() . "</code>");
    }
}
