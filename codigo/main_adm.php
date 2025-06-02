<?php
require_once 'config/config.php';
require_once 'vendor/autoload.php';
use Services\{Locadora, UploadHandler};
use Models\{Filme, Serie, Novela, Desenho};

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
umask(0);

// Debug - Verificar se as constantes foram carregadas
echo "<div class='alert alert-info'>";
echo "ARQUIVO_JSON = " . ARQUIVO_JSON . "<br>";
echo "Arquivo existe? " . (file_exists(ARQUIVO_JSON) ? "Sim" : "Não") . "<br>";
if (file_exists(ARQUIVO_JSON)) {
    echo "Conteúdo do arquivo:<br><pre>";
    echo htmlspecialchars(file_get_contents(ARQUIVO_JSON));
    echo "</pre>";
}
echo "</div>";

if (!is_dir('img/uploads')) {
    mkdir('img/uploads', 0777, true);
}
chmod('img/uploads', 0777);

$locadora = new Locadora();
$uploadHandler = new UploadHandler();

// Debug - Verificar os itens carregados
echo "<div class='alert alert-info'>";
echo "Itens carregados:<br><pre>";
var_dump($locadora->listarItens());
echo "</pre></div>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['titulo'], $_POST['sinopse'], $_POST['genero'], $_POST['tipo'])) {
        try {
            // Debug - Mostrar todos os dados do POST
            error_log("Dados do POST: " . print_r($_POST, true));
            
            // Verifica se foi selecionada uma imagem existente
            $imagemPath = null;
            if (!empty($_POST['imagem_existente'])) {
                $imagemPath = $_POST['imagem_existente'];
                error_log("Imagem existente selecionada: " . $imagemPath);
                
                // Verifica se o arquivo existe
                if (!file_exists($imagemPath)) {
                    error_log("AVISO: Arquivo de imagem não encontrado: " . $imagemPath);
                }
            } 
            // Se não foi selecionada uma imagem existente e foi feito upload
            elseif (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                error_log("Dados do arquivo enviado: " . print_r($_FILES['imagem'], true));
                $imagemPath = $uploadHandler->handleUpload($_FILES['imagem']);
                error_log("Nova imagem enviada: " . $imagemPath);
            }
            
            // Se nenhuma imagem foi fornecida, usa a imagem padrão
            if ($imagemPath === null) {
                $imagemPath = 'img/no-image.jpg';
                error_log("Usando imagem padrão: " . $imagemPath);
            }

            // Debug - Mostrar o caminho da imagem
            echo "<div class='alert alert-info'>Caminho da imagem: " . htmlspecialchars($imagemPath) . "</div>";
            
            // Cria o item apropriado baseado no tipo
            $item = match($_POST['tipo']) {
                'filme' => new Filme($_POST['titulo'], $_POST['sinopse'], $_POST['genero'], $imagemPath),
                'serie' => new Serie($_POST['titulo'], $_POST['sinopse'], $_POST['genero'], $imagemPath),
                'novela' => new Novela($_POST['titulo'], $_POST['sinopse'], $_POST['genero'], $imagemPath),
                'desenho' => new Desenho($_POST['titulo'], $_POST['sinopse'], $_POST['genero'], $imagemPath),
                default => throw new \RuntimeException('Tipo inválido')
            };

            // Debug - Verificar o item criado
            error_log("Item criado: " . print_r([
                'titulo' => $item->getTitulo(),
                'genero' => $item->getGenero(),
                'imagem' => $item->getImagem()
            ], true));
            
            // Adiciona o item ao catálogo
            $locadora->adicionarItem($item);
            $_SESSION['mensagem'] = 'Item adicionado com sucesso!';
            
        } catch (\RuntimeException $e) {
            $_SESSION['erro'] = $e->getMessage();
            error_log("Erro ao adicionar item: " . $e->getMessage());
        }
    }
}

// Debug - Mostrar o conteúdo atual do arquivo JSON
if (file_exists(ARQUIVO_JSON)) {
    error_log("Conteúdo atual do arquivo JSON: " . file_get_contents(ARQUIVO_JSON));
}

// Exibe mensagens de sucesso/erro
if (isset($_SESSION['mensagem'])) {
    echo "<div class='alert alert-success'>{$_SESSION['mensagem']}</div>";
    unset($_SESSION['mensagem']);
}
if (isset($_SESSION['erro'])) {
    echo "<div class='alert alert-danger'>{$_SESSION['erro']}</div>";
    unset($_SESSION['erro']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Importando Bootstrap e estilos personalizados -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <!-- Fav icon -->
    <link rel="shortcut icon" href="img/Logo-Streaming-Filmes-_1_.ico" type="image/x-icon">
    <!-- CSS INTERNO -->
     <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet');
    *{
        font-family: 'Poppins', sans-serif;
        color: #fff !important;
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    /* fonte para títulos */
    .title-font{
        font-family: 'Poppins', sans-serif;
    }

    /* links */
    a{
        color: #eee ;
        text-decoration: none;
    }
    a:hover{
        text-decoration: underline;
    }

    select,
    ::picker(select) {
    appearance: base-select;
    }

    /* containers */
    .common-container{
        background-color: #C60A26 !important;
        border-radius: 5px;
        max-width: 500px;
    }
    .borderless{
        border: none;
    }

    /* botões */
    .common-btn{
        background-color: #00000020;
        color: #fff;
    
        border-radius: 5px;
        padding: 0.5rem 1rem;
        max-width: fit-content;
        align-self: center;
    }
    .common-btn:hover{
        background-color: #fff;
        color: #000 !important;
    }
    .common-btn:active{
        background-color: #ddd !important;
        color: #000000 !important;
        border: 3px solid #ddd !important;
    }
    .common-btn:hover .bi, .common-btn:active .bi{
        color: #000 !important;
    }


    .common-input:focus{
        background-color: #ffffffbb;
        color: #FDFCF7;
        box-shadow: none;
        border-left: 4px solid #F31111;
        border-bottom: 4px solid #F31111;
    }
    option.common-input{
        background-color: #313131;
    }

    body{
        background-color: #313131;
    }
    .dropdown-menu{
        background-color: #313131;
    }
    .dropdown-menu .dropdown-item{
        background: none;
    }
    .dropdown-menu.custom-width {
        width: 10px;
    }
    .nav-color{
        background-color: #000000;
    }
    .nav-logo img{
        width: 75px;
        height: 75px;
    }
    .navbar-toggler {
        border:none;
    }
     .navbar-toggler:focus,
    .navbar-toggler:active {
        outline: none;
        box-shadow: none;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='white' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }
    .cover{
        background: linear-gradient(90deg, #000000 0%, #00000000 50%), url(img/foto_filmes.png) no-repeat;
        background-size: cover;
        
    }
    .log-container{
        width: 30vw;
        height: 70vh;
    }
    .log-container h1{
        width: 100%;
        text-align: center;
        margin-top: .5em;
    }
    .log-form{
        height: 80%;
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
    }
    .custom-footer {
    background-color: #585858;
    color: #fff;
    text-align: center;
    }

    footer{
        background-color: #585858;
    }

    .footer-logo img {
    width: 60px;
    height: 60px;
    }
    .listagem{
        background-color: #00000000 !important;
    }
    .listagem thead{
        border: 1px solid #fff;
        border-radius: 5px 5px 0 0;
    }
    .listagem tbody{
        border: 1px solid #fff;
        border-radius: 0 0 5px 5px;
    }
    .listagem th, .listagem td{
        background-color: #ffffff10;
    }
    .days-input{
        color: #000 !important; 
    }

    .limite{
        color: #D22424 !important;
        text-decoration: underline dashed;
    }
    @media (max-width: 767px){
        .fmsr-poster{
            max-width: 400px;
            height: 200px;
            margin-top: 0.5em;
        }
        .borderless-sm{
            border: none;
        }
        .log-container{
            width: 80vw;
            height: 80vh;
        }
        /* Responsividade */

        .footer-logo img {
            width: 50px;
            height: 50px;
        }

        .custom-footer p {
            font-size: 0.85rem;
        }
    }

    </style>
    <title>CineHome</title>
</head>
<body>
    <!-- Barra de navegação -->
    <nav class="navbar navbar-expand-lg nav-color p-3">
        <div class="container-fluid justify-content-center">
        <a href="home_adm.html" class="navbar-brand nav-logo mx-auto">
            <img src="./img/Logo Streaming Filmes.svg" alt="Logo">
        </a>
        <button class="navbar-toggler text-white border-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center text-center" id="navbarNav">
            <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="catalogo.php">Catálogo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="main_adm.php">Adicionar</a>
            </li>
            </ul>
            <!-- Menu -->
            <div class="dropdown nav-item ms-lg-auto w-100 w-lg-auto">
                <div class="d-flex justify-content-center justify-content-lg-end">
                    <div class="dropdown">
                        <button
                        class="btn common-btn dropdown-toggle w-100 text-center text-lg-end px-3"
                        type="button"
                        id="adminDropdown"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        >
                        <i class="bi bi-stars"></i> Admin
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end w-100 text-center text-lg-end" aria-labelledby="adminDropdown" style="min-width: unset;">
                        <li>
                            <a href="login.php" class="dropdown-item d-flex justify-content-between align-items-center px-3">
                            <span>Sair</span> <i class="bi bi-box-arrow-right ms-2"></i>
                            </a>
                        </li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>

        </div>
    </nav>
    

    <!-- Título -->
    <div class="text-center my-4">
        <h2 class="title-font">CineHome</h2>
    </div>

<!-- Container principal -->
<div class="container mb-4">

    <div class="row justify-content-center align-items-start gy-4 gx-4">
  
      <!-- Formulário Adicionar ao catálogo -->
      <div class="col-md-6 col-lg-5 d-flex justify-content-center">
        <div class="p-3 common-container bg-dark text-white w-100" style="max-width: 400px;">
          <h4 class="text-center">Adicionar ao catálogo</h4>
          <form method="post" class="needs-validation mt-3" novalidate enctype="multipart/form-data">
  
            <!-- Título -->
            <div class="mb-3">
              <label for="filme" class="form-label">Título</label>
              <input type="text" name="titulo" id="filme" class="form-control common-input" required>
              <div class="invalid-feedback">Campo obrigatório</div>
            </div>
  
            <!-- Sinopse -->
            <div class="mb-3">
              <label for="sinopse" class="form-label">Sinopse</label>
              <textarea class="form-control common-input" name="sinopse" id="sinopse" rows="2" required></textarea>
              <div class="invalid-feedback">Campo obrigatório</div>
            </div>
  
            <!-- Gênero -->
            <div class="mb-3">
              <label for="genero" class="form-label">Gênero</label>
              <select name="genero" id="genero" class="form-select common-input" required>
                <option value="" disabled selected>Selecione</option>
                <option value="acao">Ação</option>
                <option value="romance">Romance</option>
                <option value="comedia">Comédia</option>
                <option value="terror">Terror</option>
                <option value="drama">Drama</option>
                <option value="ficcao">Ficção Científica</option>
                <option value="animado">Animação</option>
                <option value="infantil">Infantil</option>
              </select>
            </div>
  
            <!-- Tipo -->
            <div class="mb-3">
              <label for="tipoAdicao" class="form-label">Tipo</label>
              <select name="tipo" id="tipoAdicao" class="form-select common-input" required>
                <option value="" disabled selected>Selecione</option>
                <option value="filme">Filme</option>
                <option value="serie">Série</option>
                <option value="novela">Novela</option>
                <option value="documentario">Documentário</option>
              </select>
            </div>
  
            <!-- Imagem -->
            <div class="mb-3">
              <label class="form-label">Imagem</label>
              <select name="imagem_existente" class="form-select common-input text-black mb-2">
                <option value="">Selecione uma imagem existente (opcional)</option>
                <?php
                $imagens = glob("img/*.{jpg,jpeg,png,gif}", GLOB_BRACE);
                foreach ($imagens as $imagem) {
                    $nome = basename($imagem);
                    $caminho = 'img/' . $nome;
                    echo "<option value='" . htmlspecialchars($caminho) . "'>" . htmlspecialchars($nome) . "</option>";
                }
                ?>
              </select>
              <div class="text-center mb-2">-- OU --</div>
              <label for="imagem" class="form-label">Upload de nova imagem</label>
              <input type="file" name="imagem" id="imagem" class="form-control common-input" accept="image/*">
              <div id="previewContainer" class="mt-2 text-center" style="max-width: 200px; margin: 0 auto; display: none;">
                <img id="previewImage" class="img-fluid" alt="Preview">
              </div>
            </div>

            <button class="btn common-btn w-100 mt-2" type="submit">Adicionar</button>
          </form>
        </div>
      </div>
  
      <!-- Formulário Calcular Preço -->
      <div class="col-md-6 col-lg-5 d-flex justify-content-center">
        <div class="p-3 common-container bg-dark text-white w-100" style="max-width: 400px;">
          <h4 class="text-center">Calcular Preço</h4>
          <form method="post" class="needs-validation mt-3" novalidate>
  
            <!-- Tipo -->
            <div class="mb-3">
              <label for="tipoPreco" class="form-label">Tipo</label>
              <select name="tipo" id="tipoPreco" class="form-select common-input" required>
                <option value="" selected disabled>Selecione</option>
                <option value="filme">Filme</option>
                <option value="serie">Série</option>
                <option value="novela">Novela</option>
                <option value="documentario">Documentário</option>
              </select>
            </div>
  
            <!-- Dias -->
            <div class="mb-3">
              <label for="dias" class="form-label">Tempo em dias</label>
              <input type="number" name="dias" id="dias" class="form-control common-input" min="1" required>
            </div>
  
            <button class="btn common-btn w-100 mt-2" type="submit">Calcular</button>
          </form>
        </div>
      </div>
  
    </div> 
  
    <!-- Cards-->
    <div class="row justify-content-center align-items-start gy-4 gx-4 mt-5">
  
      <!-- Debug info -->
      <div class="alert alert-info">
        <?php
        $itens = $locadora->listarItens();
        echo "<pre>";
        foreach ($itens as $item) {
            echo "Título: " . htmlspecialchars($item->getTitulo()) . "\n";
            echo "Imagem: " . htmlspecialchars($item->getImagem()) . "\n";
            echo "Arquivo existe? " . (file_exists($item->getImagem()) ? "Sim" : "Não") . "\n";
            echo "Caminho absoluto: " . realpath($item->getImagem()) . "\n\n";
        }
        echo "</pre>";
        ?>
      </div>

      <!-- Itens cadastrados -->
      <?php
      foreach ($itens as $item): 
        $imagemPath = $item->getImagem();
        // Verifica se o arquivo existe, senão usa a imagem padrão
        if (!file_exists($imagemPath)) {
            $imagemPath = './img/no-image.jpg';
        }
      ?>
      <div class="col-md-6 col-lg-5 d-flex justify-content-center">
        <div class="card bg-dark text-white w-100" style="max-width: 400px;">
          <img src="<?php echo htmlspecialchars($imagemPath); ?>" class="card-img-top fmsr-poster" alt="<?php echo htmlspecialchars($item->getTitulo()); ?>" style="height: 300px; object-fit: cover;">
          <div class="card-body text-center">
            <h4 class="card-title"><?php echo htmlspecialchars($item->getTitulo()); ?></h4>
            <p><?php echo ucfirst($item->getGenero()); ?></p>
  
            <!-- Formulário de ações -->
            <form method="POST" class="btn-group-actions d-flex flex-column gap-2">
              <input type="hidden" name="titulo" value="<?php echo htmlspecialchars($item->getTitulo()); ?>">
              <input type="hidden" name="genero" value="<?php echo htmlspecialchars($item->getGenero()); ?>">
  
              <?php if ($item->isDisponivel()): ?>
              <!-- Aluguel -->
              <div class="d-flex gap-2 justify-content-center">
                <input type="number" name="dias" class="form-control form-control-sm days-input" value="1" min="1" required style="width: 60px;">
                <button class="btn btn-primary btn-sm" type="submit" name="alugar">Alugar</button>
              </div>
  
              <!-- Ações admin -->
              <div class="d-flex gap-2 justify-content-center">
                <button class="btn btn-success btn-sm">Disponível</button>
                <button class="btn btn-secondary btn-sm" type="submit" name="editar">Editar</button>
                <button class="btn btn-danger btn-sm" type="submit" name="deletar">Deletar</button>
              </div>
              <?php else: ?>
              <div class="d-flex gap-2 justify-content-center">
                <button class="btn btn-warning btn-sm" disabled>Indisponível</button>
                <button class="btn btn-secondary btn-sm" type="submit" name="editar">Editar</button>
                <button class="btn btn-danger btn-sm" type="submit" name="deletar">Deletar</button>
              </div>
              <?php endif; ?>
            </form>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
  
    </div> 
  
  </div> 
  
  <!-- Rodapé -->
<footer class="d-flex flex-column align-items-center justify-content-center">
  <div class="nav-logo"><img src="./img/Logo_streaming(2).png" alt="Logo"></div>
  <p class="lh-1"><strong>Entre em contato:</strong> contact@cinehome.com </p>
  <p class="lh-1" style="font-size: small;">©️2025, Cinehome.com | Direitos Reservados</p>
</footer>

    <!-- js do bootstrap -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const imagemSelect = document.querySelector('select[name="imagem_existente"]');
        const imagemFile = document.querySelector('input[name="imagem"]');
        const previewContainer = document.getElementById('previewContainer');
        const previewImg = document.getElementById('previewImage');
        
        // Preview para imagem selecionada do dropdown
        imagemSelect.addEventListener('change', function() {
            if (this.value) {
                previewImg.src = this.value;
                previewContainer.style.display = 'block';
                imagemFile.value = ''; // Limpa o upload de arquivo
                console.log('Imagem selecionada:', this.value);
            } else {
                previewContainer.style.display = 'none';
            }
        });

        // Preview para arquivo enviado
        imagemFile.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(this.files[0]);
                imagemSelect.value = ''; // Limpa a seleção do dropdown
                console.log('Arquivo selecionado:', this.files[0].name);
            } else {
                previewContainer.style.display = 'none';
            }
        });
    });
    </script>
</body>
</html>