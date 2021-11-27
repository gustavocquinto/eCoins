<?php   

session_start();
include('Produtos.class.php');
include('../Banco/conectaBD.php');

if (empty($_POST['name']) || empty($_POST['value']) || empty($_POST['quant']) || empty($_FILES['file'])){
    echo "<script> confirm('Dados preenchidos incorretamente')</script>";
    echo"<meta http-equiv='refresh' content='0;url=ProdutosCsgo.php'>";
    exit();
}

$obj = new Product();

$filesTMP = $_FILES['file']['tmp_name'];
$directory = 'Produtosimagem/';
$newname = uniqid().'.png';

if(mime_content_type($filesTMP) == 'image/png'){

    move_uploaded_file($filesTMP, $directory.$newname);
    $obj->addProduct($bd, $_POST['name'], $_POST['value'], $_POST['quant'], $directory.$newname);
    echo"<script> alert('Produto adicionado com sucesso') </script>";
    echo"<meta http-equiv='refresh' content='0;url=ProdutosCsGo.php'>";
    unset($_POST);
    

}
else{
    echo"algo deu errado";
}