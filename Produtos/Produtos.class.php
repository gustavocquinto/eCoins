<?php


class Product {

    function addProduct($bd, $name, $value, $quant, $file){
        $add = $bd -> prepare("INSERT INTO
                produtos (nomeproduto, valor, quantidade, imagem)
                VALUES
                (:nomeproduto, :valor, :quantidade, :imagem)");
        $values[':nomeproduto'] = $name;
        $values[':valor'] = str_replace(",",".", $value);
        $values[':quantidade'] = $quant;
        $values[':imagem'] = $file;

        $add -> execute($values);
    }
    function attProduct(){
        
    }
    function delProduct(){
        
    }
    function showProduct(){
        
    }



}