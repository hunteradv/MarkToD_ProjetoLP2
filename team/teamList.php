<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="teamList.css">
</head>

<body>

    <?php

    session_start();

    if (!isset($_SESSION['loggedUser']) || $_SESSION['loggedUser'] === false) {
        echo "<p>Você precisa logar para acessar esta página</p>";
    } else {

        if (isset($_GET['id'])) {
            $environmentId = $_GET['id'];
            $_SESSION['environmentId'] = $environmentId;

            require_once("../header.php");
            require_once("../context.php");

            $sql = "select * from teams where idEnvironment = $environmentId";
            $result = $context->query($sql);
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
        }
    ?>
        <img src="../button-add-blue.png" alt="blue add button" class="button-add" id="open-modal">
        <img src="../users-button.png" alt="blue people button" class="button-users" onclick="listUsers()">

        <h1>Equipes</h1>

        <!-- modais -->
        <div id="fade" class="hide"></div>

        <div id="modal" class="hide">
            <div class="modal-header-i">
                <h2>Cadastrar equipe</h2>
            </div>

            <div class="modal-body">
                <form class="form">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="team-name-to-create">
                        <span class="validations" id="nameValidated"></span>
                    </div>
                    <div class="mb-3">
                        <label for="obs" class="form-label">Observação</label>
                        <input type="text" class="form-control" id="obs-to-create">
                    </div>
                </form>
            </div>

            <div class="modal-footer-i">
                <button type="button" class="btn btn-primary" onclick="validateTeam()">Cadastrar</button>
                <button type="button" class="btn btn-secondary" id="close-modal">Cancelar</button>
            </div>
        </div>

        <div id="modal-edit" class="hide">
            <div class="modal-header-i">
                <h2>Editar equipe</h2>
            </div>

            <div class="modal-body">
                <form class="form">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="team-name-to-update">
                        <span class="validations" id="nameValidated"></span>
                    </div>

                    <div class="mb-3">
                        <label for="obs" class="form-label">Observação</label>
                        <input type="text" class="form-control" id="team-obs-to-update">
                    </div>
                </form>
            </div>

            <div class="modal-footer-i">
                <button type="button" class="btn btn-primary" onclick="validateTeamToUpdate()">Atualizar</button>
                <button type="button" class="btn btn-secondary" id="close-modal-edit">Cancelar</button>
            </div>
        </div>
        <!-- fim modais -->

        <section class="teams">
            <div class="list-group">
                <?php
                foreach ($data as $line) {
                    echo "
                    <div class='list-teams'>
                        <a class='team' href='../team/team.php?id=$line[teamId]'>
                        <button type='button' class='list-group-item list-group-item-action list-team'> $line[name] </button>
                        </a>

                        <img class='edit' onclick='openModalEdit($line[teamId])' src='../pencil.svg'></img>
                        <img class='delete' onclick='deleteTeam($line[teamId])' src='../trash.svg'></img>
                    </div>
                    ";
                }
                ?>
            </div>

        </section>

        <script src="teamList.js" type="text/javascript"></script>
    <?php

        require_once("../footer.php");
    }
