<?php


class Product {

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
    function showProducts($bd){
        $sql = 'SELECT id, nomeproduto, valor, quantidade, imagem
                FROM produtos';
        $query = $bd -> query($sql);
        foreach($query as $registro){
                echo"<div id='testando2'>
                        <div id='testando3'>
                            <form class='form' id='form' method='post' action='Produtos.php'>
                                <h3> {$registro['nomeproduto']} </h3>
                                <img src='{$registro['imagem']}'>
                                <h3> Estoque: {$registro['quantidade']}</h3>
                                <h3> Valor: R$ {$registro['valor']} </h3>
                                <button type='submit' name='editar' value='{$registro['id']}'> Editar </button>
                                <br>
                                <button type='submit' name='deletar' value='{$registro['imagem']}'> Deletar </button>
                                <hr></hr>
                            </form>
                        </div>
                    </div>";
        }
        
    }
    function queryProduct($bd, $id){
        $sql = $bd -> prepare("SELECT nomeproduto, valor, quantidade, imagem
                FROM produtos
                WHERE id = {$id}");
        $sql -> execute();
        $consulta = $sql -> fetch(PDO::FETCH_ASSOC);
        echo"<form class='form' method='post' action='Produtos.php'>
                <h2> {$consulta['nomeproduto']} -- ID: {$id} </h2>
                <img src='{$consulta['imagem']}'>
                <br>
                <label for='nome'> Nome </label>
                <input type='text' name='nome' value='{$consulta['nomeproduto']}'>
                <label for='valor'> Valor </label>
                <input type='number' name='valor' value='{$consulta['valor']}'>
                <label for='quant'> Quantidade </label>
                <input type='number' name='quant' value='{$consulta['quantidade']}'>
                <br>
                <button type='submit' name='id' value='{$id}'> Aplicar alterações </button>
            </form>";

    }
    function attPage() {
        echo"<meta HTTP-EQUIV='refresh' CONTENT='0'>";
    }



}

//$id = preg_replace ('//D/', '', $id);
//Confirma se é digito, 1 virgula ve se é digito, e a na virgula 2, se nao for, ele aplica VAZIO a $id.