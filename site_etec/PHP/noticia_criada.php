<?php 
include_once "conexao.php";
date_default_timezone_set('America/Sao_Paulo');

# Checa a conexão com banco
if($conect == false){
    echo $error;
    exit;
}

$id_noticia = mysqli_real_escape_string($conn, $_GET['id']);

# Busca o registro pelo id
$qry = "SELECT * FROM `tb_noticias` WHERE noticia_id = '$id_noticia'";
$resultset = mysqli_query($conn, $qry);

# Verifica se deu certo a consulta
if (!$resultset){
    echo "Erro ao editar o registro.";
    exit;
}

$row = mysqli_fetch_assoc($resultset);

$dtFormat = converteData('padrao', $row['dtcad']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['titulo']?></title>
</head>
<style>
    h2
    {
        color: rgb(178, 0, 0);
    }
    body
    {
        color: rgb(39, 51, 54);
    }
</style>
<body>
<h2 class="pb-2 border-bottom" style="color: rgb(178, 0, 0);">Informativo ETEC de POÁ</h2>

    <main role="main" class="container">
      <div class="row">
        <div class="col-md-8 blog-main">
          <h3 class="pb-3 mb-4 font-italic border-bottom">
           <?php echo $row['titulo'] . " - " . $dtFormat?>
          </h3>

          <div class="blog-post">
            <p><?php echo $row['corpo']?></p>
            <blockquote></blockquote>
          </div><!-- /.blog-post -->
        </aside><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </main><!-- /.container -->
    <!-- <h1><?php echo $row['titulo'] . " - " . $dtFormat?></h1>
    <?php echo $row['corpo']?> -->
</body>
</html>