<?php
try{
$pdo = new PDO('mysql:host=localhost;dbname=minhalojaonline', 'root', '');
}catch(PDOException $e){
   echo "Error com banco de dados " . $e->getMessage();
}catch(Exception $e){
   echo "Erro genérico " . $e->getMessage();
}

if(isset($_GET['preco_produto'])){
    $cmd = $pdo->prepare('UPDATE produtos SET nome_produto = :nome,imagem = :imagem, valorproduto = :valorproduto, emestoque = :emestoque WHERE id_produto = :id_produto');
    $cmd->bindValue(':nome', $_GET['nome']);
    $cmd->bindValue(':imagem', $_GET['link_imagem']);
    $cmd->bindValue(':valorproduto', $_GET['preco_produto']);
    $cmd->bindValue(':emestoque', $_GET['em_estoque']);
    $cmd ->bindValue(':id_produto', $_GET['id_produto']);
    $cmd->execute();
}