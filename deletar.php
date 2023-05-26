<?php

    include("../conexao.php");

    //verificar se o ID foi fornecido
    if(!isset($_GET['id'])){
        die("ID do usuário não foi fornecido");
    }

    $id=$_GET['id'];

    $sql = "DELETE FROM usuario WHERE id = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindvalue(":id", $id);
    $stmt->execute();

    header("location: telalistagem.php");
    exit;