<?php
    include("../config/cabecalho.php");
    include("../conexao.php");
    
    $sql = "SELECT id, nome, login, email FROM usuario";

    $resultado = $conexao->query($sql);

    if($resultado->rowCount() > 0){
        echo "<table border=1>";
        echo "
            <tr>
                <th>id<?<th>
                <th>nome<?th>
                <th>login</th>
                <th>email</th>
            </tr>
        ";
        foreach($resultado as $row){
            echo "<tr>";
            echo "<td>" .$row['id']. "</td>";
            echo "<td>" .$row['nome']. "</td>";
            echo "<td>" .$row['login']. "</td>";
            echo "<td>" .$row['email']. "</td>";
            echo '<td><a href="telaeditar.php?id='.$row['id'].'">editar</a></td>';
            echo '<td><a href="deletar.php?id='.$row['id'].'">deletar</a></td>';
            echo "</tr>";
        }
        echo "</table>";
    }else{
        echo "Nenhum usuário encontrado!";
    }


    include("../config/rodape.php");
?>