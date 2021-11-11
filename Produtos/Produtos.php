<?php   

session_start();
include('Produtos.class.php');
include('../Banco/conectaBD.php');

$obj = new Product;

$filesTMP = $_FILES['file']['tmp_name'];
$directory = 'Produtosimagem/';
$newname = uniqid().'.jpeg';

if(mime_content_type($filesTMP) == 'image/jpeg'){

    move_uploaded_file($filesTMP, $directory.$newname);
    $obj->addProduct($bd, $_POST['name'], $_POST['value'], $_POST['quant'], $directory.$newname);

};
