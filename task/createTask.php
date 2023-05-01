<?php
session_start();

if (isset($_POST['title']) && isset($_POST['obs']) && isset($_POST['dueDate']) && isset($_POST['category']) && isset($_POST['status']) && isset($_POST['teamId'])) {
    $title = $_POST['title'];
    $obs = $_POST['obs'];
    $dueDate = $_POST['dueDate'];
    $category = $_POST['category'];
    $status = $_POST['status'];
    $teamId = $_POST['teamId'];

    require_once "../context.php";

    if (isset($_SESSION['userId']) || isset($_SESSION['environmentId'])) {
        $userId = $_SESSION['userId'];
        $environmentId = $_SESSION['environmentId'];

        try {
            $sql = "insert into tasks (category, title, obs, dueDate, status, teamId) values ($category, '$title', '$obs', '$dueDate', $status, $teamId)";
            $query = $context->prepare($sql);
            $result = $query->execute();
            $rs = $context->lastInsertId() or die(print_r($query->errorInfo(), true));

            echo json_encode($result);
        } catch (PDOException $ex) {
            die("Erro: <code>" . $ex->getMessage() . "</code>");
        }
    }
}
