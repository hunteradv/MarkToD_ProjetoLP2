<?php
session_start();

if (isset($_POST['teamId']) && isset($_POST['obs'])) {
    $id = $_POST['teamId'];
    $name = $_POST['name'];
    $obs = $_POST['obs'];

    require_once('../context.php');

    try {
        $sql = "update teams SET name = $name, obs = $obs where teamId = $id";
        $query = $context->prepare($sql);
        $result = $query->execute();
        $rs = $context->lastInsertId() or die(print_r($query->errorInfo(), true));

        echo json_encode($result);
    } catch (PDOException $ex) {
        die("Erro: <code>" . $ex->getMessage() . "</code>");
    }
}
