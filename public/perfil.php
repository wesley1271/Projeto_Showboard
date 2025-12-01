<?php
defined('CONTROL') or die('Acesso negado!');
include "conexao.php";



// ID do usuario

$id = $_SESSION['usuario_id'] ?? 0;
if ($id <= 0) {
  die("Usuário não logado.");
}
// Busca o usuário 
$sql = "SELECT id, nome, email, senha, avatar FROM usuarios WHERE id = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
  die("Erro na preparação da query: " . mysqli_error($conn));
}
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
  die("Erro ao consultar o banco: " . mysqli_error($conn));
}

$usuario = mysqli_fetch_assoc($result);
if (!$usuario) {
  die("Usuário não encontrado.");
}

$sqlProjetos = "SELECT * FROM projetos WHERE usuario_id = ? ORDER BY id DESC";
$stmtProjetos = mysqli_prepare($conn, $sqlProjetos);

if (!$stmtProjetos) {
  die("Erro no prepare (projetos): " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmtProjetos, 'i', $id);
mysqli_stmt_execute($stmtProjetos);
$resultProjetos = mysqli_stmt_get_result($stmtProjetos);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['avatar'], $_POST['id'])) {
  $id = intval($_POST['id']);
  $avatar = basename($_POST['avatar']);

  $sqlUpdateAvatar = "UPDATE usuarios SET avatar = ? WHERE id = ?";
  $stmtUpdate = mysqli_prepare($conn, $sqlUpdateAvatar);
  mysqli_stmt_bind_param($stmtUpdate, 'si', $avatar, $id);
  mysqli_stmt_execute($stmtUpdate);

  echo "OK";
  exit;
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil | showboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="fonts/fonts.css">
  <link rel="stylesheet" href="styles/perfil.css">

</head>

<body>

  <!-- HEADER -->
  <header>
    <img src="img/logo.png" alt="logo showboard">

    <nav class="navbar">
      <div class="hamburg">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="offcanvas offcanvas-end" id="offcanvasNavbar">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title">Barra de navegação</h5>
              <button class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>

            <a href="index.php?rota=dashboard">Meus Projetos</a>
            <a href="index.php?rota=home">Início</a>
            <a href="index.php?rota=logout">Sair</a>
          </div>
        </div>
      </div>

      <a class="projetos" href="index.php?rota=dashboard">Meus Projetos</a>
      <a class="home" href="index.php?rota=home">Início</a>
      <a class="sair" href="index.php?rota=logout">Sair</a>
    </nav>
  </header>



  <section class="perfil-container text-center">
    <h1>Perfil do Usuário</h1>

    <div class="perfil-box">

      <div class="avatar-box">
        <div class="avatar-wrapper">

          <img class="avatar-img" id="avatarAtual"
            src="<?php echo !empty($usuario['avatar']) ? 'img/avatar/' . $usuario['avatar'] : 'img/user.png'; ?>"
            alt="Avatar do usuário">

          <button id="botaoTrocarAvatar" class="avatar-button">+</button>


          <div id="seletorAvatar" class="avatar-grid">
            <?php
            $pasta = "img/avatar/";
            $arquivos = glob($pasta . "*.png");
            foreach ($arquivos as $arq): ?>
              <img class="opcao-avatar" src="<?= $arq ?>">
            <?php endforeach; ?>
          </div>

        </div>
      </div>



      <div class="box-content">
        <p><strong>Nome:</strong> <?= htmlspecialchars($usuario['nome']) ?></p>
        <p>
          <strong>Email:</strong> <span><?= htmlspecialchars($usuario['email']) ?></span>
      </p>
        <p><strong>Senha:</strong> ************</p>
      </div>

    </div>



    <section id="projects" class="projects-grid">
      <h1>Projetos recentes</h1>
      <?php
      $contador = 0;
      while ($projeto = mysqli_fetch_assoc($resultProjetos)) :

        if ($contador >= 3) break;
      ?>

        <div class="card">
          <h3><?= htmlspecialchars($projeto['titulo']) ?></h3>
          <p><?= htmlspecialchars($projeto['descricao']) ?></p>
          <a class="project-link" href="<?= htmlspecialchars($projeto['link']) ?>" target="_blank">Ver Projeto</a>

          <div class="btns-card">
            <input type="hidden" name="id" value="<?= $projeto['id'] ?>">

            <a href="index.php?rota=dashboard&edit=<?= $projeto['id'] ?>" class="btn-edit">
              <i class="fa fa-edit"></i> Editar
            </a>
            <form action="index.php?rota=deletar" method="POST" style="display:inline;"
              onsubmit="return confirm('Tem certeza que deseja deletar este projeto?');">
              <input type="hidden" name="id" value="<?= $projeto['id'] ?>">
              <button class="btn-edit" type="submit"><i class="fa-solid fa-trash"></i> Deletar</button>
            </form>
          </div>
        </div>

      <?php
        $contador++;
      endwhile;
      ?>
    </section>







    <footer class="foo-hero text-center text-lg-start">

      <section class="content-about row g-10">
        <div class="container mt-5">

          <div class="row mt-4">

            <div class="col-md-3 col-lg-4 col-xl-3 mb-4">
              <h6 class="projects-title text-uppercase fw-bold">Objetivos</h6>
              <p>
                Nossos objetivos para o projeto são de criar uma área acessível e simples para divulgação de ideias,
                focando na interatividade e conforto de nossos usuários.
              </p>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mb-4">
              <h6 class="projects-title text-uppercase fw-bold">Info</h6>

              <p><a href="https://getbootstrap.com/" class="foo-link text-white">Bootstrap</a></p>
              <p><a href="https://github.com/wesley1271/Projeto_Grafico.git" class="foo-link text-white">Projeto no Git</a></p>
              <p><a href="https://developer.mozilla.org/pt-BR/" class="foo-link text-white">MDN Web Docs</a></p>
            </div>


            <div class="col-md-3 col-lg-2 col-xl-2 mb-4">
              <h6 class="projects-title text-uppercase fw-bold">Links Úteis</h6>

              <p><a href="index.php?rota=home" class="foo-link text-white">Início</a></p>
              <p><a href="index.php?rota=perfil" class="foo-link text-white">Meu Perfil</a></p>
              <p><a href="index.php?rota=dashboard" class="foo-link text-white">Meus Projetos</a></p>
            </div>



            <div class="foo-content col-md-4   mb-md-0 mb-4">

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
    <script>
      const userId = <?= json_encode($_SESSION['usuario_id']) ?>;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="scripts/perfil.js"></script>

</body>

</html>