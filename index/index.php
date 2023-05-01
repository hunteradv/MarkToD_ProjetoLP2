<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
</head>

<body>

    <?php

    session_start();

    if (!isset($_SESSION['loggedUser']) || $_SESSION['loggedUser'] === false) {
        echo "<p>Você precisa logar para acessar esta página</p>";
    } else {
        require_once("../header.php");
        require_once("../context.php");

        $userId = $_SESSION['userId'];

        $sql = "select * from environments e join users_in_environments ue on e.environmentId = ue.environmentId where ue.userId = $userId";
        $result = $context->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);

    ?>
        <img src="../button-add-blue.png" alt="blue add button" class="button-add" id="open-modal">

        <h1>Ambientes</h1>

        <!-- modais -->
        <div id="fade" class="hide"></div>

        <div id="modal" class="hide">
            <div class="modal-header-i">
                <h2>Cadastrar ambiente</h2>
            </div>

            <div class="modal-body">
                <form class="form">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="env-name-to-create">
                        <span class="validations" id="nameValidated"></span>
                    </div>
                </form>
            </div>

            <div class="modal-footer-i">
                <button type="button" class="btn btn-primary" onclick="validateEnvironment()">Cadastrar</button>
                <button type="button" class="btn btn-secondary" id="close-modal">Cancelar</button>
            </div>
        </div>

        <div id="modal-edit" class="hide">
            <div class="modal-header-i">
                <h2>Editar ambiente</h2>
            </div>

            <div class="modal-body">
                <form class="form">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="env-name-to-update">
                        <span class="validations" id="nameValidated"></span>
                    </div>
                </form>
            </div>

            <div class="modal-footer-i">
                <button type="button" class="btn btn-primary" onclick="validateEnvironmentToUpdate()">Atualizar</button>
                <button type="button" class="btn btn-secondary" id="close-modal-edit">Cancelar</button>
            </div>
        </div>
        <!-- fim modais -->

        <section class="environments">
            <div class="list-group">
                <?php
                foreach ($data as $line) {
                    echo "
                    <div class='list-environments'>
                        <a class='environment' href='../team/teamList.php?id=$line[environmentId]'>
                        <button type='button' class='list-group-item list-group-item-action list-env'> $line[name] </button>
                        </a>

                        <img class='edit' onclick='openModalEdit($line[environmentId])' src='../pencil.svg'></img>
                        <img class='delete' onclick='deleteEnvironment($line[environmentId])' src='../trash.svg'></img>
                    </div>
                    ";
                }
                ?>
            </div>

        </section>
</body>

</html>

<script src="index.js" type="text/javascript"></script>

<?php

        require_once("../footer.php");
    }
