<?php
try{
$pdo = new PDO('mysql:host=localhost;dbname=minhalojaonline', 'root', '');
}catch(PDOException $e){
   echo "Error com banco de dados " . $e->getMessage();
}catch(Exception $e){
   echo "Erro genérico " . $e->getMessage();
}

if(isset($_GET['id_encomenda'])){
    $cmd = $pdo->prepare("DELETE FROM encomendas WHERE id_encomenda = :id_encomenda");
    $cmd->bindValue(":id_encomenda", $_GET['id_encomenda']);
    $cmd->execute();
}