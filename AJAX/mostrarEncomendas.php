<?php
try{
$pdo = new PDO('mysql:host=localhost;dbname=minhalojaonline', 'root', '');
}catch(PDOException $e){
   echo "Error com banco de dados " . $e->getMessage();
}catch(Exception $e){
   echo "Erro genérico " . $e->getMessage();
}

$cmd = $pdo->prepare("SELECT e.id_encomenda,e.datadaencomenda,e.NIF_cliente,e.quantidade,c.nome_cliente,p.nome_produto FROM encomendas AS e JOIN produtos AS p ON e.id_produto = p.id_produto JOIN clientes AS c ON e.NIF_cliente = c.NIF_cliente");
$cmd->execute();
if($cmd->rowCount() == 0){
    echo 0;
}else{
    $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($res);
}