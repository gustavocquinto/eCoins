<?php


class Product {
    function addProductPage($feedback) {
        echo"<form class='card' method='post' action='ProdutosCsGo.php' enctype='multipart/form-data' >
                <label for='name'> Nome do produto </label>
                <input type='text' name='name'>
                <label for='value'> Valor </label>
                <input type='number' name='value' step='0.01'>
                <label for='quant'> Quantidade </label>
                <input type='number' name='quant'>
                <label for='file'> Imagem do produto (<span style='color: red'>Somente PNG </span>) </label>
                <input type='file' name='file'>
                <br>";
            
            
        echo"<button class='botao'type='submit' name='Enviar' value='Enviar'> Enviar </button> 
            </form>";
    }
    function addProduct($bd, $name, $value, $quant, $file){
        $add = $bd -> prepare("INSERT INTO produtos (nomeproduto, valor, quantidade, imagem)
                               VALUES (:nomeproduto, :valor, :quantidade, :imagem)");
        $values[':nomeproduto'] = $name;
        $values[':valor'] = $value;
        $values[':quantidade'] = $quant;
        $values[':imagem'] = $file;

        $add -> execute($values);
    }
    function attProduct($bd, $id, $nome, $valor, $quant){
        if(empty($nome) || empty($valor) || empty($quant)){
            echo "<script> alert('Dados preenchidos incorretamente, as alterações não foram salvas.')</script>";
            exit();
        }
        $att = $bd -> prepare("UPDATE produtos
                               SET nomeproduto = '{$nome}', valor = '{$valor}', quantidade = '{$quant}'
                               WHERE id = {$id}");
        $att -> execute();
    }
    function delProduct($bd, $produto){
        $prepare = $bd -> prepare('DELETE FROM produtos
                                   WHERE imagem = :imagem');
                $prepare -> execute([':imagem' => $_POST['deletar']]);
        unlink($produto);
        $this->attPage();
    }
    function showProducts($bd, $perm){
        $sql = 'SELECT id, nomeproduto, valor, quantidade, imagem
                FROM produtos';
        $query = $bd -> query($sql);
        foreach($query as $registro){
            if($perm == 'admin'){    
                echo"
                            <div class='card'>
                                <form class='' method='post' action='ProdutosCsGo.php'>
                                    <h3 style='text-align: center;'> {$registro['nomeproduto']} </h3>
                                    <img id='imgg' width='280px' height= '200px' src='{$registro['imagem']}'>
                                    <h3> Estoque: {$registro['quantidade']}</h3>
                                    <h3> Valor: R$ {$registro['valor']} </h3>
                                    <button class='botao' type='submit' name='editar' value='{$registro['id']}'> Editar </button>
                                    <br>
                                    <button class='botao'type='submit' name='deletar' value='{$registro['imagem']}'> Deletar </button>
                                </form>
                        </div>";
                }
            else{
                echo"
                            <div class='card'>
                                <form class='' method='post' action='ProdutosCsGo.php'>
                                    <h3 style='text-align: center;'> {$registro['nomeproduto']} </h3>
                                    <img id='imgg' width='280px' height= '200px' src='{$registro['imagem']}'>
                                    <h3> Valor: R$ {$registro['valor']} </h3>
                                    <br>
                                    <button class='botaocomprar'type='submit' name='Comprar' value='{$registro['imagem']}'> Comprar </button>
                                </form>
                        </div>";
            }
        }
        
    }
    function queryProduct($bd, $id){
        $sql = $bd -> prepare("SELECT nomeproduto, valor, quantidade, imagem
                FROM produtos
                WHERE id = {$id}");
        $sql -> execute();
        $consulta = $sql -> fetch(PDO::FETCH_ASSOC);
        echo"<form class='card' method='post' action='ProdutosCsgo.php'>
                <h2> {$consulta['nomeproduto']} <span style='color: green;'>{$id}</span>  </h2>
                <img width='280px' height= '200px' src='{$consulta['imagem']}'>
                <br>
                <label for='nome'> Nome </label>
                <input class='input' type='text' name='nome' value='{$consulta['nomeproduto']}'>
                <label for='valor'> Valor </label>
                <input class='input' type='number' name='valor' value='{$consulta['valor']}'>
                <label for='quant'> Quantidade </label>
                <input class='input' type='number' name='quant' value='{$consulta['quantidade']}'>
                <br>
                <button type='submit' name='id' value='{$id}'> Aplicar alterações </button>
            </form>";

    }
    function attPage() {
        echo"<meta HTTP-EQUIV='refresh' CONTENT='0'>";
    }

    function WaitForSec($sec){
        $i = 1;
        $last_time = $_SERVER['REQUEST_TIME'];
        while($i > 0){
            $total = $_SERVER['REQUEST_TIME'] - $last_time;
            if($total >= 2){
                return 1;
                $i = -1;
            }
        }
    }


}

//$id = preg_replace ('//D/', '', $id);
//Confirma se é digito, 1 virgula ve se é digito, e a na virgula 2, se nao for, ele aplica VAZIO a $id.