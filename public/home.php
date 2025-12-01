<?php

defined('CONTROL') or die('Acesso negado!');
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="fonts/fonts.css">
  <link rel="stylesheet" href="styles/home.css">
  <title>showboard | Homepage</title>
</head>

<body>

  <header>
    <img src="img/logo.png" alt="logo showboard">
    <nav class="navbar">
      <div class="hamburg">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">

              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Barra de navegação</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <a href="index.php?rota=dashboard"> Meus Projetos</a>
            <a href="index.php?rota=perfil">Perfil</a>
            <a href="index.php?rota=logout">Sair</a>
          </div>
        </div>
      </div>
      <a class="projetos" href="index.php?rota=dashboard"> Meus Projetos</a>
      <a class="perfil" href="index.php?rota=perfil">Perfil</a>
      <a class="sair" href="index.php?rota=logout">Sair</a>
    </nav>
  </header>

  <section class="hero">
    <h2>Mostre e divulgue seus melhores projetos!</h2>
    <p>Gestão de projetos, crie, personalize e compartilhe porfólios interativos com facilidade! </p>
    <a href="index.php?rota=dashboard" class="hero-btn">
      Criar projeto
    </a>
  </section>

  <section id="project-about" class="container my-5">
    <h1>Sobre nosso projeto</h1>


    <div id="carousel-about" class="carousel carousel-dark slide" data-bs-ride="carousel">

      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carousel-about" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carousel-about" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carousel-about" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>

      <div class="carousel-inner">


        <div class="carousel-item active" data-bs-interval="5000">
          <img src="img/portfolio.jpg" class="d-block w-100" alt="codigo e ferramentas">
          <div class="carousel-caption d-none d-md-block">
            <h2>Linguagens e ferramentas</h2>
            <p>Utilizamos JavaScript, PHP, HTML, Bootstrap, CSS e Design Gráfico para desenvolver projetos modernos, e visualmente atraentes.</p>
          </div>
        </div>


        <div class="carousel-item" data-bs-interval="5000">
          <img src="img/interacao.png" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h2>interação com o usuário</h2>
            <p>
              A Showboard oferece interações personalizadas para que o usuário se sinta confortável utilizando a ferramenta</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/acessibilidade.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h2>Acessibilidade</h2>
            <p>A Showboard oferece interações personalizadas para que o usuário se sinta confortável utilizando a ferramenta</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carousel-about" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carousel-about" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </section>


  <footer class="foo-hero text-center text-lg-start">


    <section class="content-about">
      <div class="container text-center text-md-start mt-5">

        <div class="row mt-5">

          <div class="showboard-foo col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

            <h6 class="projects-title text-uppercase fw-bold">Objetivos</h6>

            <p>
              Nossos objetivos para o projeto são de criar uma área acessivel e simples para divulgação de ideias, focando na interatividade e conforto de nossos usuários.
            </p>
          </div>



          <div class="foo-content col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

            <h6 class="projects-title text-uppercase fw-bold">Info</h6>

            <p>
              <a href="https://getbootstrap.com/" class="foo-link text-white">Bootstrap </a>
            </p>

            <p>
              <a href="https://github.com/wesley1271/Projeto_Grafico.git" class="foo-link text-white"> Projeto no Git

              </a>
            </p>

            <p>
              <a href="https://developer.mozilla.org/pt-BR/"
                class="foo-link text-white">MDN Web Docs </a>
            </p>
          </div>



          <div class="foo-content col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

            <h6 class=" projects-title text-uppercase fw-bold">Links Úteis</h6>

            <p>
              <a href="http://localhost/Projeto_Grafico/public/index.php?" class="foo-link text-white"> Início </a>
            </p>
            <p>
              <a href="http://localhost/Projeto_Grafico/public/index.php?rota=perfil" class="foo-link text-white"> Meu Perfil </a>
            </p>
            <p>
              <a href="http://localhost/Projeto_Grafico/public/index.php?rota=dashboard" class="foo-link text-white">Meus Projetos </a>
            </p>

          </div>



     
          <div class="foo-content col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

            <h6 class="projects-title text-uppercase fw-bold">Contato dos integrantes</h6>

            <div class="team-member mb-3">
              <p class="mb-1 fw-bold">Wesley Carvalho</p>
              <div class="social-icons d-flex gap-3">
                <a href="https://github.com/wesley1271" class="integrer-a text-white" target="_blank">
                  <img src="img/github.png" alt="GitHub">
                </a>
                <a href="https://www.linkedin.com/in/-wesley-carvalho-" target="_blank" class="integrer-a text-white">
                  <img src="img/linkedin.png" alt="LinkedIn">
                </a>
                <a href="https://mail.google.com/mail/?view=cm&to=wesley0608romano@gmail.com" class="integrer-a text-white" target="_blank">
                  <img src="img/gmail.png" alt="Gmail">
                </a>
              </div>
            </div>


            <div class="team-member mb-3">
              <p class="mb-1 fw-bold">Israel dos Santos</p>
              <div class="social-icons d-flex align-items-center gap-3">

                <a href="https://www.instagram.com/israelsantosoficial/" target="_blank" class="integrer-a text-white">
                  <img src="img/instagram.png" class="insta-icon" alt="Instagram">
                </a>

                <a href="https://www.linkedin.com/in/isra-santos-570b6b1a1" target="_blank" class="integrer-a text-white">
                  <img src="img/linkedin.png" alt="LinkedIn">
                </a>

                <a href="https://outlook.office.com/mail/deeplink/compose?to=Israel.peniel@outlook.com" target="_blank" class="integrer-a text-white">
                  <img src="img/outlook.svg" alt="Outlook">
                </a>
              </div>
            </div>
            <div class="team-member mb-3">
              <p class="mb-1 fw-bold">Henry Gonçalves</p>
              <div class="social-icons d-flex align-items-center gap-3">
                <a href="https://github.com/henry121g" class="integrer-a text-white" target="_blank">
                  <img src="img/github.png" alt="GitHub">
                </a>

                <a href="https://www.instagram.com/zote_121g/" target="_blank" class="integrer-a text-white">
                  <img src="img/instagram.png" class="insta-icon" alt="Instagram">
                </a>

                <a href="https://www.linkedin.com/in/henry-gon%C3%A7alves-furtuna-06b889188/" target="_blank" class="integrer-a text-white">
                  <img src="img/linkedin.png" alt="LinkedIn">
                </a>

              </div>
            </div>

          </div>

        </div>
    </section>



    <div class="end-footer text-center p-3">
      © 2025 Copyright showboard oficial

    </div>

  </footer>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>