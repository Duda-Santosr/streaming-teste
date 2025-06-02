<?php

// Incluir o autoload
require_once __DIR__ . '/../vendor/autoload.php';

// Incluir o arquivo com as variáveis
require_once __DIR__ . '/../config/config.php';

session_start();

// Importar as classes Locadora e Auth
use Services\{Locadora, Auth};

// Importar as classes de modelos
use Models\{Serie, Filme, Desenho, Novela};

// Verificar se o usuário está logado
if(!Auth::verificarLogin()){
    header('Location: login.php');
    exit;
}

// Condição para logout
if (isset($_GET['logout'])){
    (new Auth())->logout();
    header('Location: login.php');
    exit;
}

if (!is_dir('img/uploads')) {
    mkdir('img/uploads', 0777, true);
}
chmod('img/uploads', 0777);

// Criar uma instância da classe locadora
$locadora = new Locadora();

$mensagem = '';

$usuario = Auth::getUsuario();

// Verificar os dados do formulário via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Verificar se requer permissão de administrador
    if (isset($_POST['adicionar']) || isset($_POST['deletar']) || isset($_POST['alugar']) || isset($_POST['devolver'])) {
        if (!Auth::isAdmin()) {
            $mensagem = "Você não tem permissão para realizar essa ação.";
            goto renderizar;
        }
    }

    if (isset($_POST['adicionar'])) {
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
        } catch (\RuntimeException $e) {
            $mensagem = "Erro ao fazer upload da imagem: " . $e->getMessage();
            goto renderizar;
        }
        $titulo = $_POST['titulo'];
        $sinopse = $_POST['sinopse'];
        $genero = $_POST['genero'];
        $tipo = $_POST['tipo'];

        if ($tipo == 'serie'){
            $item = new Serie($titulo, $sinopse, $genero, $imagemPath);
        } elseif($tipo == 'filme'){
            $item = new Filme($titulo, $sinopse, $genero, $imagemPath);
        } elseif ($tipo == 'desenho'){
            $item = new Desenho($titulo, $sinopse, $genero, $imagemPath);
        } elseif ($tipo == 'novela'){
            $item = new Novela($titulo, $sinopse, $genero, $imagemPath);
        } else {
            $mensagem = "Escolha um tipo válido.";
            goto renderizar;
        }

        $locadora->adicionarItem($item);

        $mensagem = "Item adicionado com sucesso!";
    }
    }
    elseif(isset($_POST['alugar'])){

        $dias = isset($_POST['dias']) ? (int)$_POST['dias'] : 1;
        $mensagem = $locadora->alugarItem($_POST['titulo'], $dias);
    }
    elseif(isset($_POST['devolver'])){
        $mensagem = $locadora->devolverItem($_POST['titulo']);
    }
    elseif(isset($_POST['deletar'])){
        $mensagem = $locadora->deletarItem($_POST['titulo'], $_POST['genero']);
    }
    elseif(isset($_POST['calcular'])){
        $dias = (int)$_POST['diasCalculo'];
        $tipo = $_POST['tipoCalculo'];
        $valor = $locadora->calcularPrevisaoAluguel($tipo, $dias);

        $mensagem = "Previsão de valor para {$dias} dias: R$ " . number_format($valor, 2, ',', '.');
        $_POST = []; // Limpar os dados do formulário após alugar
    }
}


renderizar:
require_once __DIR__ . '/../views/template.php';