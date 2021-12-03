<?php 


if (empty($_POST['nome']) || empty($_POST['sobrenome']) || empty($_POST['email']) || empty($_POST['telefone']) or empty($_POST['senha'])){
    echo'<script> alert("Dados preenchidos incorretamente.") </script>';
    include('registro.html');
    exit();
}

require_once('C:\Users\Gustavo\Xampps\htdocs\eCoins\Banco\conectaBD.php');


$consulta = $bd -> prepare('SELECT 
                            telefone, email
                            FROM 
                            usuarios
                            WHERE
                            email = :email');

$consulta -> execute([':email' => $_POST['email']]);
$registro = $consulta -> fetch(PDO::FETCH_ASSOC);

//Estava dando um erro Warning: Trying to access array offset on value of type bool in C:\Users\Gustavo\Xampps\htdocs\tsi-php-2021\eCoins\registro\registro.php on line 22
//Porque o $registro nao encontrava a consulta correspondente, nao achou o email que recebemos do usuario no banco, entao nao $registro nao virava um array
//Logo ao jogarmos isso no if ele tentava acessar um array que nao existe ocasionando no erro. Arrumamos usando and, vendo se o $registro existe, se existe é porque encontrou no banco um email correspondente e virou um array.
if ($registro && $_POST['email'] == $registro['email']){
    echo'<script> alert("Email já utilizado. ") </script>';
    include('registro.html');
    exit();
}


$preparando = $bd -> prepare(
    'INSERT usuarios (nome, sobrenome, email, senha, telefone)
     VALUES (:nome, :sobrenome, :email, :senha, :telefone)');

$valores[':nome'] = $_POST['nome'];
$valores[':sobrenome'] = $_POST['sobrenome'];
$valores[':email'] = $_POST['email'];
$valores[':senha'] = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$valores[':telefone'] = $_POST['telefone'];

//password_hash($_POST['senha'], PASSWORD_DEFAULT);

if($preparando -> execute($valores)){
    echo'<script> alert("Dados coletados com sucesso.") </script>';
    echo"<meta http-equiv='refresh' content='0;url=../Login/login.html'>";
}
else{
    echo'<script> alert("Algo deu errado") </script>';
}

