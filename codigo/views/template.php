<?php

require_once __DIR__ .'/../services/Auth.php';

use Services\Auth;

$usuario = Auth::getUsuario();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Importando Bootstrap e estilos personalizados -->
   <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Fav icon -->
    <link rel="shortcut icon" href="img/Logo-Streaming-Filmes-_1_.ico" type="image/x-icon">
    <!-- CSS INTERNO -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap&quot; rel="stylesheet');
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
            background-color: #ccc !important;
            color: #000000 !important;
            border: none !important;
        }
        .common-btn:hover .bi, .common-btn:active .bi{
            color: #000 !important;
        }
        /* Botões minimalistas do carrossel */
    .carousel-control-prev,
    .carousel-control-next {
      width: 30px;
      height: 30px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      padding: 0;
      opacity: 0.8;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      background-color: transparent;
      /* border: solid white; */
      /* border-width: 0 4px 4px 0; */
      width: 16px;
      height: 16px;
    }

    .carousel-control-prev-icon {
      transform: rotate(0deg);
    }

    .carousel-control-next-icon {
      transform: rotate(0deg);
    }
    .carousel-item img {
      height: auto;
      max-height: 230px;
      width: 100%;
      max-width: 150px;
      object-fit: cover;
      border-radius: 10px;
    }
    .carousel-item {
      padding: 0 1rem;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      border-radius: 50%;
    }

    .category-section {
      margin: 2rem 0;
    }

    /* Redução do tamanho das imagens do carrossel de banners */
    #banners-container .carousel-inner img {
      max-height: 580px;
      max-width: 95%;
      margin: 0 auto;
      object-fit: cover;
      border-radius: 8px;
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
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg&#39; viewBox='0 0 30 30'%3e%3cpath stroke='white' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
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

            #banners-container .carousel-inner img {
             max-height: 200px;
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
            <img src="../img/Logo Streaming Filmes.svg" alt="Logo">
        </a>
        <button class="navbar-toggler text-white border-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center text-center" id="navbarNav">
            <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="#HOME">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#CATALOGO">Catálogo</a>
            </li>
            <?php if (Auth::isUser()): ?>
            <li class="nav-item">
                <a class="nav-link" href="#ALUGUE">Assinatura</a>
            </li>
            <?php endif; ?>
            <?php if (Auth::isAdmin()): ?>
            <li class="nav-item">
                <a class="nav-link" href="#ALUGUE">Adicionar</a>
            </li>
            <?php endif; ?>
            
            <!-- Menu -->
            <div class="dropdown nav-item ms-lg-auto w-100 w-lg-auto">
                <div class="d-flex justify-content-center justify-content-lg-end">
                    <div class="dropdown d-flex justify-content-left">
                        <button class="btn common-btn dropdown-toggle w-100 text-center text-lg-end px-3 "type="button"id="adminDropdown"data-bs-toggle="dropdown"aria-expanded="false">
                            <?php if (Auth::isUser()): ?><i class="bi bi-person-circle"></i> <?php endif; ?>
                        <?php if (Auth::isAdmin()): ?>
                        <i class="bi bi-stars"></i> <?php endif; ?> <?= htmlspecialchars($usuario['username'])?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end w-100 text-center text-lg-end" aria-labelledby="adminDropdown" style="min-width: unset;">
                        <li>
                            <div class="d-flex align-items-center gap-3 user-info">
                                <!-- Botão Sair com ícone usando Bootstrap Icons -->
                                <a href="?logout=1" class="btn  d-flex align-items-center gap-1 d-flex justify-content-center" >
                                    <i class="bi bi-box-arrow-right"></i>
                                    Sair
                                </a>
                            </div>
                        </li>
                        </ul>
                    </div>
                </div>
            </div>
            </ul>

        </div>
    </div>
    </nav>
   
   

    <!-- Título -->
    <div class="text-center my-4">
        <h2 class="title-font">CineHome</h2>
    </div>

   
        <!-- ############## HOME ############ -->

    <div id="HOME">
        <!-- Título e subtítulo -->
        <div class="container my-5 text-center align-center d-flex justify-content-center">
            <div class="card common-container borderless p-4">
            <div class="card-header fs-3 fw-bold"><span class="welcome-text">Bem-vindo, <strong><?= htmlspecialchars($usuario['username'])?></strong></span></div>
            <div class="card-body">
                <p class="card-text fs-5">Veja a recomendação de filme e série da semana</p>
            </div>
            </div>
        </div>
        <!-- Carrossel de Banners -->
        <div class="container my-5" id="banners-container">
            <div id="slider" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="../img_home/conclave.jpg" class="d-block w-100 img-fluid" alt="Conclave" />
                </div>
                <div class="carousel-item">
                <img src="../img_home/peaky-blinders2.jpeg" class="d-block w-100 img-fluid" alt="Vale Tudo" />
                </div>
                <div class="carousel-item">
                <img src="../img/greysanatomy (1).jpg" class="d-block w-100 img-fluid" alt="Peaky Blinders" />
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Próximo</span>
            </button>
            </div>
        </div>
        <!-- Carrossel de Assinaturas -->
        <div class="container mb-4">
            <div class="card-header fs-5 fw-semibold">Minhas Assinaturas</div>
            <div id="carouselAssinaturas" class="carousel slide mt-3" data-bs-ride="carousel">
            <div class="carousel-inner text-center">
                <!-- Página 1 -->
                <div class="carousel-item active">
                <div class="row justify-content-center">
                    <div class="col-6 col-md-3 mb-3 d-flex justify-content-center">
                    <img src="../img_home/you.jpg" class="poster-img" alt="Avenida Brasil">
                    </div>
                    <div class="col-6 col-md-3 mb-3 d-flex justify-content-center">
                    <img src="../img_home/wicked.jpg" class="poster-img" alt="Vale Tudo">
                    </div>
                    <div class="col-6 col-md-3 mb-3 d-flex justify-content-center">
                    <img src="../img_home/pantanal.png" class="poster-img" alt="Peaky Blinders">
                    </div>
                    <div class="col-6 col-md-3 mb-3 d-flex justify-content-center">
                    <img src="../img_home/Breaking_bad.jpg" class="poster-img" alt="Liga da Justiça">
                    </div>
                </div>
                </div>
                <!-- Página 2 -->
                <div class="carousel-item">
                <div class="row justify-content-center">
                    <div class="col-6 col-md-3 mb-3 d-flex justify-content-center">
                    <img src="../img_home/pecadores.jpg" class="poster-img" alt="Como Treinar seu Dragão 2">
                    </div>
                    <div class="col-6 col-md-3 mb-3 d-flex justify-content-center">
                    <img src="../img_home/stranger_things.jpg" class="poster-img" alt="Chiquititas">
                    </div>
                    <div class="col-6 col-md-3 mb-3 d-flex justify-content-center">
                    <img src="../img_home/outroladodoparaiso.jpg" class="poster-img" alt="Cobra Kai">
                    </div>
                    <div class="col-6 col-md-3 mb-3 d-flex justify-content-center">
                    <img src="../img_home/simpsons.jpg" class="poster-img" alt="Bosko Looney Tunes">
                    </div>
                </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carrosselAssinaturas" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carrosselAssinaturas" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
            </div>
        </div>
        <!-- Texto Final -->
        <div class="container my-5">
            <p class="fs-6 catalogo-texto">
            Já terminou de assistir ou quer ver mais filmes e séries?<br />
            Veja o nosso catálogo por mais filmes e séries!<br />
            <a href="catalogo.php" class="text-decoration-underline text-info fw-semibold">Clique aqui</a> para ir ao catálogo.
            </p>
        </div>
    </div>

  <!-- ############### FIM HOME ##################### -->

    <!-- ##### CATALOGO ######### -->
     <?php if (Auth::isUser()): ?>
        <!-- Barra de pesquisa -->
        <div class="search-bar text-center mb-4">
        <form class="d-flex justify-content-center" role="search">
            <input
            class="form-control me-2 bg-dark border-0 text-white"
            type="search"
            placeholder="Buscar títulos..."
            aria-label="Buscar"
            style="max-width: 400px;"
            />
            <button class="btn btn-outline-dark" type="submit">
            <i class="bi bi-search"></i>
            </button>
        </form>
        </div>
    <?php endif; ?>


        <?php if (Auth::isUser()): ?>
        <!-- Seções de conteúdo -->
        <div class="container" id="CATALOGO">
            <!-- Filmes -->
            <div class="category-section">
                <h5 class="text-uppercase text-center">Filmes</h5>
                <div id="carouselFilmes" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <div class="d-flex justify-content-center flex-wrap gap-3">
                        <img src="img_catalogo/Ainda_Estou_Aqui_poster.jpg" class="img-fluid" alt="Ainda Estou Aqui">
                        <img src="img_catalogo/bonequinha_de_luxo.jpg" class="img-fluid" alt="Bonequinha de Luxo">
                        <img src="img_catalogo/Jurassic_Park_poster.jpg" class="img-fluid" alt="Jurassic Park">
                        <img src="../img/vingadores.jpg" class="img-fluid" alt="Vingadores">
                        <img src="img_catalogo/titanic.jpg" class="img-fluid" alt="Titanic">
                    </div>
                    </div>
                    <div class="carousel-item">
                    <div class="d-flex justify-content-center flex-wrap gap-3">
                        <img src="img_catalogo/matrix.jpg" class="img-fluid" alt="Matrix">
                        <img src="img_catalogo/pantera_negra.jpg" class="img-fluid" alt="Pantera Negra">
                        <img src="img_catalogo/coringa.jpg" class="img-fluid" alt="Coringa">
                        <img src="img_catalogo/homem_aranha.jpg" class="img-fluid" alt="Homem-Aranha">
                        <img src="img_catalogo/interestrelar.jpg" class="img-fluid" alt="Interestelar">
                    </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselFilmes" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselFilmes" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
                </div>
            </div>
            <br>

            <!-- Séries -->
            <div class="category-section">
                <h5 class="text-uppercase text-center">Séries</h5>
                <div id="carouselSeries" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <div class="d-flex justify-content-center flex-wrap gap-3">
                        <img src="img_catalogo/breaking_bad.jpg" class="img-fluid" alt="Breaking Bad">
                        <img src="img_catalogo/stranger_things.jpg" class="img-fluid" alt="Stranger Things">
                        <img src="img_catalogo/game_of_thrones.jpg" class="img-fluid" alt="Game of Thrones">
                        <img src="img_catalogo/Dark.jpg" class="img-fluid" alt="Dark">
                        <img src="img_catalogo/the_office.jpg" class="img-fluid" alt="The Office">
                    </div>
                    </div>
                    <div class="carousel-item">
                    <div class="d-flex justify-content-center flex-wrap gap-3">
                        <img src="img_catalogo/friends.jpg" class="img-fluid" alt="Friends">
                        <img src="img_catalogo/sherlok.jpg" class="img-fluid" alt="Sherlock">
                        <img src="img_catalogo/house.jpg" class="img-fluid" alt="House">
                        <img src="img_catalogo/peaky_blinders.jpg" class="img-fluid" alt="Peaky Blinders">
                        <img src="img_catalogo/the_witchar.jpg" class="img-fluid" alt="The Witcher">
                    </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselSeries" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselSeries" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
                </div>
            </div>
            <br>

            <!-- Novelas -->
            <div class="category-section">
                <h5 class="text-uppercase text-center">Novelas</h5>
                <div id="carouselNovelas" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <div class="d-flex justify-content-center flex-wrap gap-3">
                        <img src="img_catalogo/avenida_brasil.jpg" class="img-fluid" alt="Avenida Brasil">
                        <img src="img_catalogo/heias_de_charme.jpg" class="img-fluid" alt="Cheias de Charme">
                        <img src="img_catalogo/o_rei_do_gado.jpg" class="img-fluid" alt="O Rei do Gado">
                        <img src="img_catalogo/amor-a-vida.jpg" class="img-fluid" alt="Amor à Vida">
                        <img src="img_catalogo/caminho_das_indias.jpg" class="img-fluid" alt="Caminho das Índias">
                    </div>
                    </div>
                    <div class="carousel-item">
                    <div class="d-flex justify-content-center flex-wrap gap-3">
                        <img src="img_catalogo/por_amor.jpg" class="img-fluid" alt="Por Amor">
                        <img src="img_catalogo/belissima.jpg" class="img-fluid" alt="Belíssima">
                        <img src="img_catalogo/lacos_de_famili.jpg" class="img-fluid" alt="Laços de Família">
                        <img src="img_catalogo/o_clone.jpg" class="img-fluid" alt="O Clone">
                        <img src="img_catalogo/senhora_do_destino.jpg" class="img-fluid" alt="Senhora do Destino">
                    </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselNovelas" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselNovelas" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
                </div>
            </div>
            <br>

            <!-- Desenhos -->
            <div class="category-section">
                <h5 class="text-uppercase text-center">Desenhos</h5>
                <div id="carouselDesenhos" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <div class="d-flex justify-content-center flex-wrap gap-3">
                        <img src="img_catalogo/scooby_doo.jpg" class="img-fluid" alt="Scooby-Doo">
                        <img src="img_catalogo/tom_e_jerry.jpg" class="img-fluid" alt="Tom e Jerry">
                        <img src="../img/picapau.jpg" class="img-fluid" alt="Pica-Pau">
                        <img src="img_catalogo/os_simpsons_jpg.webp" class="img-fluid" alt="Os Simpsons">
                        <img src="img_catalogo/phineas_e_ferb.jpg" class="img-fluid" alt="Phineas e Ferb">
                    </div>
                    </div>
                    <div class="carousel-item">
                    <div class="d-flex justify-content-center flex-wrap gap-3">
                        <img src="img_catalogo/futurama.jpg" class="img-fluid" alt="Futurama">
                        <img src="img_catalogo/steven_universe.jpg" class="img-fluid" alt="Steven Universe">
                        <img src="img_catalogo/looney_tunes.jpg" class="img-fluid" alt="Looney Tunes">
                        <img src="img_catalogo/ben_10.jpg" class="img-fluid" alt="Ben 10">
                        <img src="img_catalogo/meninas_super_poderosas.jpg" class="img-fluid" alt="Meninas Superpoderosas">
                    </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselDesenhos" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselDesenhos" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
    <!-- #### FIM CATALOGO ##### -->

  <!-- ######### ALUGUE ######### -->
    <div id="ALUGUE">
        <!-- Container principal -->
        <div class="container mb-4 mt-4">
            <div class="row justify-content-center align-items-start gy-4 gx-4">

        <?php if (Auth::isAdmin()): ?>
            <!-- Título -->
        <div class="text-center my-4">
            <h2 class="title-font">
                Adicionar
            </h2>
        </div>
        
        
          <!-- Formulário Adicionar ao catálogo -->
          <div class="col-md-6 col-lg-5 d-flex justify-content-center">
            <div class="p-3 common-container bg-dark text-white w-100" style="max-width: 400px;">
              <h4 class="text-center">Adicionar ao catálogo</h4>
              <form class="needs-validation" method="POST" enctype="multipart/form-data" novalidate></form>
              <!-- NAO REMOVA ESSE FORM OU O FORMULÁRIO DE ADICIONAR PARA DE FUNCIONAR -->
              <form method="post" class="needs-validaton" novalidate>
                <!-- Título -->
                <div class="mb-3">
                  <label class="form-label">Título</label>
                  <input type="text" name="titulo" class="form-control common-input text-black" required>
                  <div class="invalid-feedback">Campo obrigatório</div>
                </div>
                <!-- Sinopse -->
                <div class="mb-3">
                  <label class="form-label">Sinopse</label>
                  <textarea class="form-control common-input text-black" name="sinopse" rows="2" required></textarea>
                  <div class="invalid-feedback">Campo obrigatório</div>
                </div>
                <!-- Gênero --> 
                <div class="mb-3">
                  <label class="form-label">Gênero</label>
                  <select name="genero" class="form-select common-input text-black" required>
                    <option value="" hidden selected aria-invalid="true">Selecione</option> <option value="acao" class="text-black">Ação</option>
                    <option value="romance" class="text-black">Romance</option> <option value="comedia" class="text-black">Comédia</option>
                    <option value="terror" class="text-black">Terror</option> <option value="drama" class="text-black">Drama</option>
                    <option value="ficcao" class="text-black">Ficção Científica</option> <option value="animado" class="text-black">Animação</option>
                    <option value="infantil" class="text-black">Infantil</option>
                  </select>
                </div>
                <!-- Tipo -->
                <div class="mb-3">
                  <label class="form-label">Tipo</label>
                  <select name="tipo" class="form-select common-input text-black" required>
                    <option value="" hidden selected aria-invalid="true">Selecione</option>
                    <option value="filme" class="text-black">Filme</option>
                    <option value="serie" class="text-black">Série</option>
                    <option value="novela" class="text-black">Novela</option>
                    <option value="desenho" class="text-black">Desenho</option>
                  </select>
                </div>
                <!-- Imagem -->
                <!-- <div class="mb-3">
                  <label for="imagem" class="form-label">Adicionar Imagem</label>
                  <input type="file" name="imagem" id="imagem" class="form-control common-input" required>
                </div> -->
                <button type="submit" class="btn common-btn w-100 mt-2" name="adicionar">Adicionar</button>
                <?php if(isset($_POST['cadastrar'])){echo "<p>item adicionado com sucesso</p>";}?>
              </form>
            </div>
          </div>
        <?php endif; ?>

        <br>
        <br>
        
        <?php if (Auth::isUser()): ?>
        <!-- Título -->
        <div class="text-center my-4">
            <h2 class="title-font">
                Previsão
            </h2>
        </div>
        <?php endif; ?>

          <!-- Formulário Calcular Preço -->
          <div class="col-<?= Auth::isAdmin() ? 'md-6':'12' ?> col-lg-5 d-flex justify-content-center">
            <div class="p-3 common-container bg-dark text-white w-100" style="max-width: 400px;">
              <h4 class="text-center">Calcular Preço</h4>
              <form method="post" class="needs-validation mt-3" novalidate>
                <!-- Tipo -->
                <div class="mb-3">
                  <label class="form-label">Tipo</label>
                  <select name="tipoCalculo" class="form-select common-input text-black" required>
                    <option value="" selected hidden>Selecione</option>
                    <option value="filme" class="text-black">Filme</option>
                    <option value="serie" class="text-black">Série</option>
                    <option value="novela" class="text-black">Novela</option>
                    <option value="desenho" class="text-black">Documentário</option>
                  </select>
                </div>
                <!-- Dias -->
                <div class="mb-3">
                  <label class="form-label">Tempo em dias</label>
                  <input type="number" name="diasCalculo" class="form-control common-input text-black " min="1" required>
                </div>
                <button class="btn common-btn w-100 mt-2" type="submit" name="calcular">Calcular</button>

              </form>
            </div>
          </div>
        </div>
        <br>
        <br>
        <?php if ($mensagem):?>
                <div class="alert alert-danger alert-dismissible fade show text-danger" role="alert">
                <?= htmlspecialchars($mensagem) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        <?php endif; ?>
        <br>
        <br>

        <!-- Cards-->
        <div class="row justify-content-center align-items-start gy-4 gx-4 mt-5">
        <!-- Itens cadastrados -->
        <?php foreach ($locadora->listarItens() as $item): ?>
            <div class="col-md-6 col-lg-5 d-flex justify-content-center">
            <div class="card bg-dark text-white w-100" style="max-width: 400px;">
                <img src="../" class="card-img-top fmsr-poster" alt="Poster">
                <div class="card-body text-center">
              <h4 class="card-title"><?= htmlspecialchars($item->getTitulo()) ?></h4>
              
                <p><?= $item instanceof \Models\Filme ? 'Filme' : (
                $item instanceof \Models\Serie ? 'Serie' : (
                $item instanceof \Models\Novela ? 'Novela' : 'Desenho')
                );?>
                </p>
              <!-- Formulário de ações -->
              <form method="POST" class="btn-group-actions d-flex flex-column gap-2">
                <!-- Campo oculto para identificar o item -->
                <input type="hidden" name="titulo" value="<?= htmlspecialchars($item->getTitulo()) ?>">
                <input type="hidden" name="genero" value="<?= htmlspecialchars($item->getGenero()) ?>">
                <div class="d-flex gap-2 justify-content-center">
                  <span class="badge bg-<?= $item->isDisponivel() ? 'success' : 'warning' ?>">
                    <?= $item->isDisponivel() ? 'Disponível' : 'Alugado' ?>
                  </span>
                </div>
                <?php if (Auth::isAdmin()): ?>
                <?php if ($item->isDisponivel()): ?>
                  <!-- Aluguel -->
                  <div class="d-flex gap-2 justify-content-center">
                    <input type="number" name="dias" class="form-control form-control-sm days-input" value="1" min="1" required style="width: 60px;">
                    <button class="btn btn-primary btn-sm" type="submit" name="alugar">Alugar</button>
                  </div>
                <?php else: ?>
                  <!-- Devolução -->
                  <div class="d-flex gap-2 justify-content-center">
                    <button type="submit" name="devolver" class="btn btn-warning btn-sm">Devolver</button>
                  </div>
                <?php endif; ?>
                  <!-- Ações Admin -->
                  <div class="d-flex gap-2 justify-content-center mt-2">
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

    <!-- ######### FIM ALUGUE ######### --> 
     
 
  </div>

  <script>
  document.querySelector("form").addEventListener("submit", function (e) {
    e.preventDefault();
    const searchValue = e.target.querySelector("input").value.toLowerCase();
 
    document.querySelectorAll(".carousel-inner .carousel-item").forEach((item) => {
      const images = item.querySelectorAll("img");
      let hasMatch = false;
 
      images.forEach((img) => {
        const altText = img.alt.toLowerCase();
        const parent = img.parentElement;
 
        if (altText.includes(searchValue)) {
          img.style.display = "";
          hasMatch = true;
        } else {
          img.style.display = "none";
        }
      });
 
      item.style.display = hasMatch ? "block" : "none";
    });
  });
  </script>  
 
    <!-- Rodapé -->
    <footer class="d-flex flex-column align-items-center justify-content-center">
    <div class="nav-logo"><img src="../img/Logo_streaming(2).png" alt="Logo"></div>
    <p class="lh-1"><strong>Entre em contato:</strong> contact@cinehome.com </p>
    <p class="lh-1" style="font-size: small;">©️2025, Cinehome.com | Direitos Reservados</p>
    </footer>

    <!-- js do bootstrap -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>