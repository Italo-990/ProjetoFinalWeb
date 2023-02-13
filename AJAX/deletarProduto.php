<?php
 try{
$pdo = new PDO('mysql:host=localhost;dbname=minhalojaonline', 'root', '');
}catch(PDOException $e){
    echo "Error com banco de dados " . $e->getMessage();
}catch(Exception $e){
    echo "Erro genérico " . $e->getMessage();
}

if(isset($_GET['delete'])){
    $cmd = $pdo->prepare("SELECT * FROM encomendas WHERE id_produto = :idproduto");
        $cmd->bindValue(":idproduto", $_GET['delete']);
        $cmd->execute();
        if($cmd->rowCount() > 0){
            echo 0;
        }else{
            $cmd = $pdo->prepare("DELETE FROM produtos WHERE id_produto = :idproduto");
            $cmd->bindValue(":idproduto", $_GET['delete']);
            $cmd->execute();
            echo 1;
        }
}
