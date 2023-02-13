<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['adminUser'])){
    header("location:adminLogin.php");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='css/adicionarProduto.css' rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Adicionar Produto</title>
</head>
<body>
<button id='button_voltar'><a href='admnistradorIndex.php'>Voltar</a></button>
<div class='form'>
    <form id='form' method='POST' autocomplete="off">
            <h1>Insira os dados do  novo produto</h1>
        <div class="form-control">
            <div class='label-control'><label for='nome_produto'>Nome - Produto</label></div>
            <input type='text' name='nome_produto' id='nome_produto'>
        </div>
        <div class="form-control">
        <div class='label-control'><label for='preco_produto'>Preço - Produto</label></div>
            <input type='number' name='preco_produto' id='preco_produto'>
        </div>
        <div class="form-control">
            <div class='label-control'><label for='em_estoque'>Quantidade em estoque</label></div>
            <input type='number' name='em_estoque' id='em_estoque'>
        </div>
        <div class="form-control">
            <div class='label-control'><label for='link_imagem'>Link - imagem</label></div>
            <input type='text' name='link_imagem' id='link_imagem'>
        </div>
        <div class="submit-control">
            <input type="submit" id = 'adicionar_produtos_submit'value="Adicionar">
        </div>
    </form>
</div>
<div class='form' style='position:relative;bottom:0px;'>
        <h2 style='border-bottom:1px solid #0d9555;'>Pré visualização</h2>
        <div class ='divprodutos'>
            <h2><span id='nome_produto_visualizacao'></span> - <span id='valor_produto_visualizacao'></span>€</h2>
            <div class='divimg'><img id='imagem_produto_visualizacao'></img></div>
            <p>Quantidade em estoque : <input id='inputemestoque' class='inputemestoque'type='number' disabled value=""></p>
      </div>
</div>
<script src='JS/adicionarProduto.js'></script>
</body>
</html>