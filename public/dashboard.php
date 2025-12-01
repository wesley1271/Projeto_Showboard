<?php
include "conexao.php";
defined('CONTROL') or die('Acesso negado!');


// id do usuario 
$id_user = $_SESSION['usuario_id'] ?? null;

if (!$id_user) {
  die("Usuário não autenticado.");
}

// Buscar todos os projetos no banco
$query = "SELECT * FROM projetos WHERE usuario_id = $id_user ORDER BY id DESC";

$result = mysqli_query($conn, $query);
if (!$result) {
  die("Erro na consulta: " . mysqli_error($conn));
}


?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Meus Projetos</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="fonts/fonts.css">
  <link rel="stylesheet" href="styles/dashboard.css">

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
            <a href="index.php?rota=home"> Início</a>
            <a href="index.php?rota=perfil">Perfil</a>
            <a href="index.php?rota=logout">Sair</a>
          </div>
        </div>
      </div>
      <a class="home" href="index.php?rota=home"> Início</a>
      <a class="perfil" href="index.php?rota=perfil">Perfil</a>
      <a class="sair" href="index.php?rota=logout">Sair</a>
    </nav>
  </header>


  <main class="hero-main">
    <h1>Crie e personalize seus melhores projetos!</h1>
    <p>Transforme suas ideias em experiências incríveis — tudo em um só lugar.</p>
    <button class="btn-add-project" id="btn-add">+ Adicionar Projeto</button>
  </main>

  <!-- Listagem dos projetos -->
  <section id="projects" class="projects-grid">
    <?php while ($projeto = mysqli_fetch_assoc($result)) : ?>
      <div class="card">
        <h3><?= htmlspecialchars($projeto['titulo']) ?></h3>
        <p><?= htmlspecialchars($projeto['descricao']) ?></p>
        <a href="<?= htmlspecialchars($projeto['link']) ?>" target="_blank">Ver Projeto</a>

        <div class="btns-card">
          <input type="hidden" name="id" value="<?= $projeto['id'] ?>">
          <button class="btn-edit" type="button"
            data-id="<?= $projeto['id'] ?>"
            data-titulo="<?= htmlspecialchars($projeto['titulo']) ?>"
            data-desc="<?= htmlspecialchars($projeto['descricao']) ?>"
            data-link="<?= htmlspecialchars($projeto['link']) ?>">
            <i class="fa fa-edit"></i> Editar
          </button>
          <form action="index.php?rota=deletar" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja deletar este projeto?');">
            <input type="hidden" name="id" value="<?= $projeto['id'] ?>">
            <button type="submit"><i class="fa-solid fa-trash"></i> Deletar</button>

          </form>
        </div>
      </div>
    <?php endwhile; ?>
  </section>

  <!-- Modal para adicionar projeto -->
  <div class="overlay" id="overlay" role="dialog" aria-modal="true">
    <form action="index.php?rota=projeto" id="form-create" method="POST" class="form-create">
      <h1 class="title">Criar projeto</h1>
      <label for="titulo">Título do Projeto</label>
      <input type="text" id="titulo" name="titulo" placeholder="Ex: Site Portfólio Pessoal" required>
      <span id="erro-title" class="erro"></span>

      <label for="descricao">Descrição</label>
      <textarea id="descricao" name="descricao" placeholder="Descreva seu projeto..."></textarea>
      <span id="erro-desc" class="erro"></span>

      <label for="link">Link do Projeto</label>
      <input type="url" id="link" name="link" placeholder="https://meuprojeto.com" required>
      <span id="erro-link" class="erro"></span>

      <button type="submit">Salvar Projeto</button>
      <button type="button" id="btnFechar">Fechar</button>
    </form>
  </div>



  <!-- Modal para editar projeto -->
  <div class="overlay" id="overlay-edit" role="dialog" aria-modal="true">
    <form action="index.php?rota=update" class="form-create" id="form-edit" method="POST" class="form-create">
      <h1 class="title">Alterar Projeto</h1>

      <input type="hidden" id="id-edit" name="id" value="">
      <label for="titulo">Título do Projeto</label>
      <input type="text" id="titulo-edit" name="titulo" placeholder="Ex: Site Portfólio Pessoal" required>
      <span id="erro-title-edit" class="erro"></span>

      <label for="descricao-edit">Descrição</label>
      <textarea id="descricao-edit" name="descricao" placeholder="Descreva seu projeto..." required></textarea>
      <span id="erro-desc-edit" class="erro"></span>

      <label for="link-edit">Link do Projeto</label>
      <input type="url" id="link-edit" name="link" placeholder="https://meuprojeto.com" required>
      <span id="erro-link-edit" class="erro"></span>


      <button type="submit">Salvar Alterações</button>
      <button type="button" id="btnFechar-edit">Fechar</button>
    </form>
  </div>

  <div class="toastDEL" id="toast">Projeto criado com sucesso!</div>
  <div class="toastDEL" id="toastDEL">Projeto excluido com sucesso!</div>
  <div class="toastDEL" id="toastEdit">Projeto editado com sucesso!</div>


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
              <a href="http://localhost/Projeto_Grafico/public/index.php?rota=home" class="foo-link text-white"> Início </a>
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
  <script src="scripts/dashboard.js" defer></script>
</body>



</html>