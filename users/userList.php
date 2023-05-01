<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="userList.css">
</head>

<body>

    <?php

    session_start();

    if (!isset($_SESSION['loggedUser']) || $_SESSION['loggedUser'] === false) {
        echo "<p>Você precisa logar para acessar esta página</p>";
    } else {

        $environmentId = $_SESSION['environmentId'];
        $userId = $_SESSION['userId'];
        require_once("../header.php");
        require_once("../context.php");

        $sql = "SELECT * from users u join users_in_environments ue ON u.userId = ue.userId WHERE ue.environmentId = $environmentId";
        $result = $context->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);

    ?>
        <img src="../button-add-blue.png" alt="blue add button" class="button-add" id="open-modal">

        <h1>Usuários</h1>

        <!-- modais -->

        <div id="fade" class="hide"></div>

        <div id="modal" class="hide">
            <div class="modal-header-i">
                <h2>Usuários disponíveis para vincular ao ambiente</h2>
            </div>
            <?php
            $sql = "SELECT * from users_in_environments ue
            join users u on ue.userId = u.userId
            where (ue.environmentId != $environmentId or ue.environmentId is null) and ue.userId != $userId";
            $result = $context->query($sql);
            $dataAdd = $result->fetchAll(PDO::FETCH_ASSOC);

            ?>
            <section class="users-modal">
                <div class="list-group">
                    <?php
                    foreach ($dataAdd as $lineAdd) {
                        echo "                
                        <div class='list-users'>                    
                        <div class='iser'>
                        <button type='button' class='list-group-item list-group-item-action list-user' onClick='selectUser($lineAdd[userId])'>$lineAdd[name]</button>                    
                        </div>
                            
                        </div>";
                    }
                    ?>
                </div>
            </section>

            <button type="button" class="btn btn-secondary" id="close-modal">Cancelar</button>
        </div>

        <div id="modal-edit" class="hide">
            <div class="modal-header-i">
                <h2>Editar usuário</h2>
            </div>

            <div class="modal-body">
                <form class="form">
                    <div class="mb-3">
                        <label for="role" class="form-label">Função</label>
                        <input type="text" class="form-control" id="user-role-to-update">
                    </div>
                </form>
            </div>

            <div class="modal-footer-i">
                <button type="button" class="btn btn-primary" onclick="validateUserToUpdate()">Atualizar</button>
                <button type="button" class="btn btn-secondary" id="close-modal-edit">Cancelar</button>
            </div>
        </div>
        <!-- fim modais -->

        <section class="users">
            <div class="list-group">
                <?php
                foreach ($data as $line) {
                    echo "
                    <div class='list-users'>
                        <div class='user'>
                        <p class='list-group-item list-group-item-action list-user'> $line[name] </p>
                        </div>

                        <img class='edit' onclick='openModalEdit($line[userId])' src='../pencil.svg'></img>
                        <img class='delete' onclick='deleteUser($line[userId])' src='../trash.svg'></img>
                    </div>
                    ";
                }
                ?>
            </div>

        </section>

        <script src="userList.js" type="text/javascript"></script>
    <?php

        require_once("../footer.php");
    }
