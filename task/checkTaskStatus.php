<?php
session_start();

if (isset($_GET['taskId'])) {
    $id = $_GET['taskId'];

    require_once('../context.php');

    try {
        $sql = "SELECT status FROM tasks WHERE taskId = $id";
        $query = $context->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        $status = $result['status'];

        echo json_encode($status);
    } catch (PDOException $ex) {
        die("Erro: <code>" . $ex->getMessage() . "</code>");
    }
}
?>