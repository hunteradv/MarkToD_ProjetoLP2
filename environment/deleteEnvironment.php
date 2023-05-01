<?php
session_start();

if (isset($_POST['environmentId'])) {
    $id = $_POST['environmentId'];

    require_once('../context.php');

    try {
        $sql = "delete from users_in_environments where environmentId = $id";
        $query = $context->prepare($sql);
        $result = $query->execute();
        $rs = $context->lastInsertId() or die(print_r($query->errorInfo(), true));

        $sql2 = "delete from environments where environmentId = $id";
        $query2 = $context->prepare($sql);
        $result2 = $query2->execute();
        $rs2 = $context->lastInsertId() or die(print_r($query->errorInfo(), true));

        echo json_encode($result2);
    } catch (PDOException $ex) {
        die("Erro: <code>" . $ex->getMessage() . "</code>");
    }
}
