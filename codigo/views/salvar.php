<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $sinopse = $_POST['sinopse'];
    $genero = $_POST['genero'];
    $tipo = $_POST['tipo'];
    $disponivel = isset($_POST['disponivel']) ? true : false;

    // Validar e mover imagem
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
        $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
        $permitidas = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($extensao, $permitidas)) {
            die('Formato de imagem não suportado.');
        }

        if (!is_dir('imagens')) {
            mkdir('imagens', 0777, true);
        }

        $nomeImagem = uniqid() . '.' . $extensao;
        $caminho = 'imagens/' . $nomeImagem;

        if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)) {
            die('Erro ao salvar a imagem.');
        }
    } else {
        die('Nenhuma imagem enviada.');
    }

    // Carregar dados existentes
    $dados = file_exists('dados.json') ? json_decode(file_get_contents('dados.json'), true) : [];

    // Adicionar novo item
    $dados[] = [
        'titulo' => $titulo,
        'sinopse' => $sinopse,
        'genero' => $genero,
        'tipo' => $tipo,
        'disponivel' => $disponivel,
        'imagem' => $nomeImagem
    ];

    file_put_contents('dados.json', json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    header('Location: index.php');
    exit;
}