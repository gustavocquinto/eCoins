<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="ProdutosCsGo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">
    <title>Produtos CsGo</title>

</head>

<body>
    <div>
        <image src="ProdutosCsGo/csgo.png" />
    </div>
    <div class="products-list">
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
    <div class="footer">
        <div class="footer-content">
            <div class="footer-content-title">
                NAVEGUE PELO SITE
            </div>
            <div class="footer-content-item">
                PÁGINA INICIAL
            </div >
            <div class="footer-content-item">
                CRÉDITOS CSGO
            </div >
            <div class="footer-content-item">
                CRÉDITOS PARA LOL
            </div >
            <div class="footer-content-item">
                CRÉDITOS PARA FORTNITE
            </div >
        </div>
        <div class="footer-content">
            <div class="footer-content-title">
                ENTRE EM CONTATO CONOSCO
            </div>
            <div class="footer-content-item">
                Email: leonnardo1588@gmail.com
            </div>
            <div class="footer-content-item">
                Precisa de suporte? <a href="#"> Clique Aqui</a>
            </div>
            <div class="footer-content-item">
                Tel:(11) 5555-5555
            </div>
        </div>
        <div class="footer-content">
            <div class="footer-content-title">
                REDES SOCIAIS   
            </div>
            <div class="footer-content-item">
                Facebook
            </div>
            <div class="footer-content-item">
                Instagram
            </div>
            <div class="footer-content-item">
                Twitter
            </div>
        </div>
    </div>


</body>

</html>