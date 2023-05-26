<?php
    include("../config/cabecalho.php");
?>
<div class="container">
    <h1>Registro de usuário</h1>
<form action="" method="POST">
    <label for="nome">Nome</label>
    <input type="text" name="nome" required placeholder="Informe seu nome">

    <label for="login">Login</label>
    <input type="text" name="login" required placeholder="Informe seu login">

    <label for="email">E-mail</label>
    <input type="email" name="email" required placeholder="Informe seu E-mail">

    <label for="password">Senha</label>
    <input type="password" name="senha" required placeholder="Informe sua senha">

    <button type="submit">Registrar-se</button>
</form>

<?php
    //conectar com o banco
    include("../conexao.php");

    //função para verificar se o usuário já está cadastrado
    function usuario_cadastrado($email) {
        global $conexao;

        $sql = "SELECT COUNT(*) FROM usuario WHERE email = :email";
        $stmt = $conexao->prepare($sql);
        $stmt->execute(["email" => $email]);
        $count = $stmt->fetchColumn();

        return $count > 0;
    }

    //formulario foi enviado?
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nome = $_POST["nome"];
        $login = $_POST["login"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        if (usuario_cadastrado($email)) {
            echo "<div class='error'>Este e-mail já está cadastrado.</div>";
        } else {
            $sql = "INSERT INTO usuario(nome, login, email, senha) VALUES (:nome, :login, :email, :senha)";
            $stmt = $conexao->prepare($sql);
            $stmt->execute([
                "nome" => $nome,
                "login" => $login,
                "email" => $email,
                "senha" => md5($senha)
            ]);

            if($stmt->rowCount() > 0){
                echo "<div class='sucess'>Usuário cadastrado com sucesso.</div>";
            }else {
                echo "<div class='error'>Erro ao cadastrar o usuário.</div>";
            }
        }

        //fechar a conexão
        $conexao = null;
    }
?>
