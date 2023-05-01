<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="login.js"></script>
    <title>Mark 2 do</title>
</head>

<?php
session_start();

if (isset($_SESSION['loggedUser']) && $_SESSION['loggedUser'] === true)
    header("Location: ../index/index.php");
?>

<body>
    <section class="login">
        <h1 class="title-app">Mark 2 do</h1>
        <div class="div-form-blue">
            <div class="div-form-white">
                <form class="form" action="doLogin.php">
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                        <span class="validations" id="emailValidated"></span>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password">
                        <span class="validations" id="passwordValidated"></span>
                    </div>

                    <div class="buttons">
                        <button type="button" class="btn btn-primary btn-lg" onclick="validateLogin()">Login</button>
                        <a href="../register/register.php"><button type="button" class="btn btn-link">Registrar</button></a>
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