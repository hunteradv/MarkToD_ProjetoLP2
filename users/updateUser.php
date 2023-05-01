<?php
session_start();

if (isset($_POST['userId']) && isset($_POST['role'])) {
    $userId = $_POST['userId'];
    $role = $_POST['role'];

    require_once('../context.php');

    try {
        $sql = "update users SET role = '$role' where userId = $userId";
        $query = $context->prepare($sql);
        $result = $query->execute();
        $rs = $context->lastInsertId() or die(print_r($query->errorInfo(), true));

        echo json_encode($result);
    } catch (PDOException $ex) {
        die("Erro: <code>" . $ex->getMessage() . "</code>");
    }
}
