<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="team.css">
</head>

<body>

    <?php

    session_start();

    if (!isset($_SESSION['loggedUser']) || $_SESSION['loggedUser'] === false) {
        echo "<p>Você precisa logar para acessar esta página</p>";
    } else {

        if (isset($_GET['id'])) {
            $teamId = $_GET['id'];

            require_once("../header.php");
            require_once("../context.php");

            $sql = "select * from tasks where teamId = $teamId ORDER BY status ASC";
            $result = $context->query($sql);
            $data = $result->fetchAll(PDO::FETCH_ASSOC);

            $sqlcategory = "select taskCategoryId, name from taskcategories";
            $stmt = $context->prepare($sqlcategory);
            $stmt->execute();
            $resultCat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
    ?>

        <img src="../button-add-blue.png" alt="blue add button" class="button-add" id="open-modal">
       

        <h1>
        <div class="modal-header-i" style="display: flex; justify-content: flex-end;">
        <button type="button" class="btn btn-primary" onclick="createTaskCategorie()">Nova Categoria de Tarefa</button>
        </div>    
        </h1>

        <!-- modais -->
        <div id="fade" class="hide"></div>

        <div id="modal" class="hide">
            <div class="modal-header-i">
                <h2>Cadastrar tarefa</h2>
            </div>

           <div class="modal-body">
                <form class="form">
                   <div class="mb-3">
                        <label for="name" class="form-label">Tarefa</label>
                        <input type="text" class="form-control" id="taskname">
                        <span class="validations" id="nameValidated"></span>
                    </div>
                    <div class="mb-3">
                    <label for="category">Categoria:</label>
                         <select id="task-category-to-create" name="category" class="form-control">
                         <option value="">Selecione uma categoria</option>
                          <?php
                          foreach($resultCat as $resultCat) {
                            echo "<option value=\"{$resultCat['taskCategoryId']}\">{$resultCat['name']}</option>";
                            }
                         ?>
                        </select>
                    </div>            
                    <div class="mb-3">
                        <label for="obs" class="form-label">Atividade a ser realizada</label>
                        <input type="text" class="form-control" id="task-obs-to-create">
                    </div>
                    <div class="mb-3">
                        <label for="validade" class="form-label">Data validade</label>
                        <input type="date" class="form-control" id="task-dateval-to-create">
                    </div>
                    <div class="mb-3">
                        <label for="Status" class="form-label">Status da tarefa</label>
                        <select name="taskStatus" class="form-control" id="task-status-to-create">
                            <option value="1">Aberta</option>
                            <option value="2">Finalizada</option>
                        </select>
                    </div> 
                    <input type="hidden" name="team_id" value="<?php echo $_GET['id']; ?>" id="task-team-id">
                </form>
            </div>

            <div class="modal-footer-i">
                <button type="button" class="btn btn-primary" onclick="validateTask()">Cadastrar</button>
                <button type="button" class="btn btn-secondary" id="close-modal">Cancelar</button>
            </div>
        </div>

        <div id="modal-edit" class="hide">
            <div class="modal-header-i">
                <h2>Editar tarefa</h2>
            </div>

            <div class="modal-body">
                <form class="form">
                <div class="mb-3">
                        <label for="name" class="form-label">Tarefa</label>
                        <input type="text" class="form-control" id="task-name-to-update">
                        <span class="validations" id="statusValidated"></span>
                    </div>
                    <div class="mb-3">
                        <label for="obs" class="form-label">Atividade a ser realizada</label>
                        <input type="text" class="form-control" id="task-obs-to-update">
                    </div>

                </form>
            </div>

            <div class="modal-footer-i">
                <button type="button" class="btn btn-primary" onclick="validateTaskToUpdate()">Atualizar</button>
                <button type="button" class="btn btn-secondary" id="close-modal-edit">Cancelar</button>
             <button type="button" class="btn btn-secondary" onclick="validateTaskToFinish()"id="finish-modal-edit">Finalizar</button>
            </div>
        </div>
        <!-- fim modais -->

        <section class="tasks">
            <div class="list-group">
                <?php
                foreach ($data as $line) 
                {
                    $status_text = "";
                if ($line['status'] == 1) {
                    $status_text = "aberto";
                }   elseif ($line['status'] == 2) {
                        $status_text = "Finalizado";
                        } else {
                            $status_text = "desconhecido";
                                }

                $delete_onclick = "";
                if ($line['status'] != 2) {
                    $delete_onclick = "deleteTask(" . $line['taskId'] . ")";
                }               

                                            
                    echo
                                        
                    "
                    <div class='list-tasks'>
                        
                        <button type='button' class='list-group-item list-group-item-action list-task'> Tarefa: $line[title] <br> Vencimento: $line[dueDate] <br> Status: $status_text 
                        </button>
                        </a>

                        <img class='edit' onclick='openModalEdit($line[taskId])' src='../pencil.svg'></img>
                        <img class='delete' onclick='deleteTask($line[taskId])' src='../trash.svg' ></img>
                        
                        
                    </div>
                    ";
                }
                ?>
            </div>

        </section>
        <script src="team.js" type="text/javascript"></script>
                

    <?php

        require_once("../footer.php");
    }
