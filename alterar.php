<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<?php
$pdo = new PDO('mysql:host=localhost;dbname=crud2', 'root', '');

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = $pdo->prepare("SELECT * FROM tb_usuario WHERE id = $id");
    $sql->execute();
    $usuarios = $sql->fetchAll();

    foreach ($usuarios as $usuario) {
        echo "<form method='POST'>";
        echo "<legend>Insira os dados abaixo</legend>";
        echo "<fieldset>";
        echo "<div>";
        echo "Nome: <input type='text' class='form-control' name='nome' value='" . $usuario['nome'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "CPF: <input type='text' class='form-control' name='cpf' value='" . $usuario['cpf'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "Email: <input type='text' class='form-control' name='email' value='" . $usuario['email'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "<input type='submit' class='btn btn-primary' value='Enviar'>";
        echo "<input type='reset' class='btn btn-primary' value='Limpar Dados'>";
        echo "</div>";
        echo "<br>";
        echo "</fieldset>";
        echo "</form>";
    }
}

if (isset($_POST['nome'])) {
    $sql = $pdo->prepare("UPDATE tb_usuario SET nome = ?, cpf = ?, email = ? WHERE id = $id");
    $sql->execute(array($_POST['nome'], $_POST['cpf'], $_POST['email']));
    echo "<h1>Usuário com id = $id alterado com sucesso!</h1>";
    echo "<a href='index.php'>Voltar</a>";
}