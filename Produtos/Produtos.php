<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="produtos.css">
    <title>Document</title>
</head>
<body>
    <div id="testando">
        <a style="font-size: 35px;" href="CadProdutos.html"> Cadastrar novo produto </a>
        <?php
            include('../Banco/conectaBD.php');
            include('Produtos.class.php');

            $obj = new Product();

            if (isset($_POST['deletar'])){
                $obj-> delProduct($bd, $_POST['deletar']); 
            }
            if (isset($_POST['editar'])){
                $obj -> queryProduct($bd, $_POST['editar']);
            }
            else{
                $obj-> showProducts($bd);
            }
            if(isset($_POST['id'])){
                $obj-> attProduct($bd, $_POST['id'], $_POST['nome'], $_POST['valor'], $_POST['quant']);
                $obj->attPage();
                unset($_POST);   
            }


        ?>
    </div>
    </body>
</html>