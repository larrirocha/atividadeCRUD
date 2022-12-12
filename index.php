<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <link rel="stylesheet" href="style/style.css">
  </head>
  <body>
    <?php
      $pdo = new PDO("mysql:host=localhost;dbname=crud2", "root", "");
      $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      if(isset($_POST['nome'])){
        $sql = $pdo -> prepare("INSERT INTO tb_usuario VALUES (null, ?, ?, ?)");
        $sql -> execute(array($_POST['nome'], $_POST['cpf'],$_POST['email']));
      }
      if(isset($_GET['excluir'])){
        $id = (int) $_GET['excluir'];
        $pdo->exec("DELETE FROM tb_usuario WHERE id = $id");
        
    }
  
    ?>
    <div class="container" class="p-3 mb-2 bg-secondary text-white">
        <form method="POST">
            <legend>
    <h2>Cadastro Cliente</h2>
            </legend>
            <fieldset>
                <p>
            <div class="row mb-3">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Nome Completo:</label>
 
    <input type="text" class="form-control" id="colFormLabel" name="nome" placeholder="João da Silva">
  </div>
    <p>
  <div class="row mb-3">
  <label for="colFormLabel" class="col-sm-2 col-form-label">CPF:</label>
    <input type="text" class="form-control" id="colFormLabel" name="cpf" placeholder="111.222.333-44" 
    onkeypress="$(this).mask('000.000.000-00');">
  </div> </p>
    <p>
  <div class="row mb-3">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Email:</label>
    <input type="email" class="form-control" id="colFormLabel" name="email" placeholder="exemplo@exemplo.com">
  </div> </p>

  <div>
    <input type="submit" id="botaoEnviar" class="botao" value="Enviar">
    <input type="reset" id="botaoClear" class="botao" value="Limpar Dados">
  </div> 
    </fieldset>
    </form>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <?php
    $sql = $pdo -> prepare("SELECT * FROM tb_usuario");
    $sql -> execute();
    $usuarios = $sql -> fetchAll();
      
    echo "<table class= 'table table-stripped table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th scope='col'class='text-center'>Nome</th>";
    echo "<th scope='col'class='text-center'>CPF</th>";
    echo "<th scope='col'class='text-center'>Email</th>";
    echo "<th scope='col' colspan='2' class='text-center'>Ações</th>";
    echo "</tr></thead>";

    foreach($usuarios as $usuario){
      echo "<tr>";
      echo "<td align=center>" . $usuario['nome'] . "</td>";
      echo "<td align=center>" . $usuario['cpf'] . "</td>";
      echo "<td align=center>" . $usuario['email'] . "</td>";
      echo '<td align=center><a href="?excluir='. $usuario['id']. '">Exluir</a> </td>';
      echo '<td align=center><a href="?alterar.php?id=' . $usuario['id'].'">Alterar </a></td>';
      echo "</tr>";
      }
    ?>
  </body>
</html>