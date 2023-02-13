<?php
try{
$pdo = new PDO('mysql:host=localhost;dbname=minhalojaonline', 'root', '');
}catch(PDOException $e){
   echo "Error com banco de dados " . $e->getMessage();
}catch(Exception $e){
   echo "Erro genérico " . $e->getMessage();
}

if(isset($_GET['nome'])){
    $cmd = $pdo->prepare("INSERT INTO produtos(nome_produto,imagem,valorproduto,emestoque)VALUES(:nome,:imagem,:valorproduto,:emestoque)");
    $cmd->bindValue(":nome", $_GET['nome']);
    $cmd->bindValue(":imagem", $_GET['imagem']);
    $cmd->bindValue(":valorproduto", $_GET['valorproduto']);
    $cmd->bindValue(":emestoque", $_GET['emestoque']);
    $cmd->execute();
}