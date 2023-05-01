<?php
session_start();

if (isset($_POST['taskId']) && isset($_POST['title'])&& isset($_POST['obs'])) {
    $id = $_POST['taskId'];
    $title = $_POST['title'];
    $obs = $_POST['obs'];

    require_once('../context.php');

    try {
        $sql = "update tasks SET title = '$title', obs = '$obs' where taskId = $id";
        $query = $context->prepare($sql);
        $result = $query->execute();
        $rs = $context->lastInsertId() or die(print_r($query->errorInfo(), true));

        echo json_encode($result);
    } catch (PDOException $ex) {
        die("Erro: <code>" . $ex->getMessage() . "</code>");
    }
}
