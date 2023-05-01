<?php
session_start();

if (isset($_POST['environmentId']) && isset($_POST['name'])) {
    $id = $_POST['environmentId'];
    $name = $_POST['name'];

    require_once('../context.php');

    try {
        $sql = "update environments SET name = '$name' where environmentId = $id";
        $query = $context->prepare($sql);
        $result = $query->execute();
        $rs = $context->lastInsertId() or die(print_r($query->errorInfo(), true));

        echo json_encode($result);
    } catch (PDOException $ex) {
        die("Erro: <code>" . $ex->getMessage() . "</code>");
    }
}
