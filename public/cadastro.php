<?php

include "conexao.php";
defined('CONTROL') or die('Acesso negado!');
$nome = $senha = $email = "";
$nomeErr = $senhaErr = $emailErr = $senhaConfirmErr = $msgSucess = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Nome
    if (empty($_POST['nome'])) {
        $nomeErr = "O nome é obrigatório.";
    } elseif (strlen(trim($_POST['nome'])) < 3) {
        $nomeErr = "O nome deve ter ao menos 3 caracteres.";
    } else {
        $nome = trim($_POST['nome']);
    }

   
    if (empty($_POST['senha'])) {
        $senhaErr = "A senha é obrigatória.";
    } elseif (strlen(trim($_POST['senha'])) < 6) {
        $senhaErr = "A senha deve ter ao menos 6 caracteres.";
    }

 
    if (empty($_POST['confirm_senha'])) {
        $senhaConfirmErr = "Confirmação obrigatória.";
    } elseif ($_POST['confirm_senha'] !== $_POST['senha']) {
        $senhaConfirmErr = "Senhas não coincidem.";
    } else {
        $senha = password_hash(trim($_POST['senha']), PASSWORD_DEFAULT);
    }

    
    if (empty($_POST['email'])) {
        $emailErr = "O email é obrigatório.";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "E-mail inválido.";
    } else {
        $email = trim($_POST['email']);
    }

  
    if (empty($nomeErr) && empty($senhaErr) && empty($emailErr) && empty($senhaConfirmErr)) {
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

        if (mysqli_query($conn, $sql)) {
            header("Location: index.php?rota=login&success=1");
            exit;
        } else {
            $emailErr = "Erro ao cadastrar: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fonts/fonts.css">
    <link rel="stylesheet" href="styles/cadastro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Cadastro - Showboard</title>
</head>

<body>
    <main class="cadaster-container">
        <section class="cadaster-box">

            <div class="cadaster-title">
                <img src="img/logo.png" alt="logo showboard">
            </div>

            <h3>Crie uma conta!</h3>
            <p>Uma nova experiência na interatividade profissional!</p>

            <form action="index.php?rota=cadastro" id="cadaster-form" method="POST" class="cadaster-form">

                <!-- Nome -->
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" placeholder="Digite seu nome:" value="<?= htmlspecialchars($nome) ?>">
                    <span id="nomeErr" class="error-message"><?= $nomeErr ?></span>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Digite seu e-mail:" value="<?= htmlspecialchars($email) ?>">
                    <span id="emailErr" class="error-message"><?= $emailErr ?></span>
                </div>


                <div class="form-group senha-group">
                    <label for="senha">Senha</label>
                    <div class="senha-wrapper">
                        <input type="password" id="senha" name="senha" placeholder="Digite sua senha:">

                        <i class="fa-solid fa-eye eye" id="desocultar"></i>
                        <i class="fa-solid fa-eye-slash eye" id="ocultar"></i>
                    </div>


                    <span id="senhaErr" class="error-message"><?= $senhaErr ?></span>
                </div>

                <div class="form-group senha-group">
                    <label for="confirm-senha">Confirmar senha</label>

                    <div class="senha-wrapper">
                        <input type="password" id="confirm-senha" name="confirm_senha" placeholder="Confirme sua senha:">

                        <i class="fa-solid fa-eye eye" id="confirm-desocultar"></i>
                        <i class="fa-solid fa-eye-slash eye" id="confirm-ocultar"></i>
                    </div>

                    <span id="senhaConfirmErr" class="error-message"><?= $senhaConfirmErr ?></span>
                </div>

                <button id="btn" type="submit">Registrar</button>

                <p class="back-text">
                    Já tem uma conta? <a href="index.php?rota=login">Login</a>
                </p>

            </form>
        </section>
    </main>

    <script src="scripts/cadastro.js"></script>
</body>

</html>