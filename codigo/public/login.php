<?php

// Incluir o autoload do composer para carregar automaticamente as classes utilizadas
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

session_start();

use Services\Auth;

$mensagem = '';
$auth = new Auth();

// Se já estiver logado, redireciona para index
if (Auth::verificarLogin()) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($auth->login($username, $password)) {
        header('Location: index.php');
        exit;
    } else {
        $mensagem = 'Usuário ou senha inválidos';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CineHome - Login</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <style>
     @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap&quot; rel="stylesheet');

    * {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, html {
      height: 100%;
      overflow: hidden;
    }

    .bg-container {
      position: relative;
      width: 100%;
      height: 100vh;
      background: url('../img/foto_filmes.png') no-repeat left center;
      background-size: cover;
    }

    .form-overlay {
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      width: 40%;
      display: flex;
      justify-content: center;
      align-items: center;
      background: rgba(0, 0, 0, 0.6);
    }

    .form-box {
      width: 100%;
      max-width: 360px;
      padding: 2rem;
      background-color: rgba(0, 0, 0, 0.7);
      border-radius: 12px;
      color: white;
      z-index: 2;
    }

    .common-input {
      background-color: #fff;
      color: #000 !important;
    }

    .common-input:focus {
      background-color: #ffffffdd;
      color: #000 !important;
      box-shadow: none;
    }

    .btn-danger {
      background-color: #D22424;
      border: none;
      padding: 0.75rem;
      font-weight: bold;
      letter-spacing: 1px;
      transition: background-color 0.2s ease;
    }

    .btn-danger:hover {
      background-color: #a71c1c;
    }

    .form-label {
      font-size: 1.2rem;
      font-weight: 500;
    }

    .text-link {
      text-align: center;
      margin-top: 1rem;
    }

    .text-link a {
      color: #ff4c4c;
      text-decoration: none;
    }

    .text-link a:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .form-overlay {
        width: 100%;
        background-color: rgba(0, 0, 0, 0.85);
      }

      .bg-container {
        background-position: top center;
        background-size: contain;
      }
    }
  </style>
</head>
<body>
  <div class="bg-container">
    <div class="form-overlay">
      <div class="form-box">
        <h1 class="mb-4 text-center" style="letter-spacing: 2px;">LOGIN</h1>

         <?php if ($mensagem) :?>
            <div class="alert alert-danger"><?= htmlspecialchars($mensagem)?></div>
            <?php endif; ?>

                <form method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label class="form-label">Usuário</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Senha</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-danger w-100">Entrar</button>
                </form>
        <div class="text-link">
          Ainda não tem cadastro? <a href="cadastro.php">Cadastre-se</a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>