<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script type="text/javascript" src="register.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;900&display=swap" rel="stylesheet">
    <title>Mark 2 do</title>
</head>

<body>
    <section class="register">
        <h1 class="title-app">Mark 2 do</h1>
        <div class="div-form-blue">
            <div class="div-form-white">
                <form id="form" class="form" action="doRegister.php" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" required>
                        <span id="nameValidated" class="validations"></span>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" required>
                        <span class="validations" id="emailValidated"></span>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" required>
                        <span class="validations" id="passwordValidated"></span>
                    </div>

                    <div class="mb-3">
                        <label for="passwordConfirm" class="form-label">Confirmar senha</label>
                        <input type="password" class="form-control" id="passwordConfirm" required>
                        <span class="validations" id="passwordConfirmValidated"></span>
                    </div>

                    <div class="buttons">
                        <button type="button" class="btn btn-primary btn-lg" onclick="validateRegister()">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>

<?php
require_once("../footer.php");
?>