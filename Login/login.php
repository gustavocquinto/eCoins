<?php

session_start();
require('C:\Users\Gustavo\Xampps\htdocs\eCoins\Banco\conectaBD.php');
/*if (empty($_POST['email']) || empty($_POST['password'])){
    echo '<script> Os dados fornecidos estão incorretos. </script>';
    include('login.html');
}*/
$consulta = $bd -> prepare('SELECT
                            nome, email, senha
                            FROM
                            usuarios
                            WHERE
                            email = :email');

if($_POST){
    $consulta -> execute([':email' => $_POST['email']]);
    $retornoConsulta = $consulta -> fetch(PDO::FETCH_ASSOC);

        if($retornoConsulta && $_POST['email'] == $retornoConsulta['email'] && password_verify($_POST['password'], $retornoConsulta['senha'])){
            $_SESSION['usuario'] = $retornoConsulta['nome'];
            echo'<script> alert("Usuário autenticado") </script>';
            echo"<meta http-equiv='refresh' content='0;url=menu.html'>";
        
        }
        else{
            echo'<script> alert("Dados incorretos") </script>';
            include ('login.html');
        }
}

else{
    echo'<script> alert("Dados incorretos") </script>';
    include ('login.html');
}
                            
                            




