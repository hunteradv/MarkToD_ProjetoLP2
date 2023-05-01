<?php
session_start();

if (isset($_POST['name']) && isset($_POST['obs'])) {
    $name = $_POST['name'];
    $obs = $_POST['obs'];

    require_once "../context.php";

    if (isset($_SESSION['userId']) || isset($_SESSION['environmentId'])) {
        $userId = $_SESSION['userId'];
        $environmentId = $_SESSION['environmentId'];

        try {
            $sql = "insert into teams (name, obs, teamHead, idEnvironment) values ('$name', '$obs', $userId, $environmentId)";
            $query = $context->prepare($sql);
            $result = $query->execute();
            $rs = $context->lastInsertId() or die(print_r($query->errorInfo(), true));

            echo json_encode($result);
        } catch (PDOException $ex) {
            die("Erro: <code>" . $ex->getMessage() . "</code>");
        }
    }
}
