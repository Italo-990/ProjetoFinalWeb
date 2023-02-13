<?php
try{
$pdo = new PDO('mysql:host=localhost;dbname=minhalojaonline', 'root', '');
}catch(PDOException $e){
   echo "Error com banco de dados " . $e->getMessage();
}catch(Exception $e){
   echo "Erro genérico " . $e->getMessage();
}

$res = array();
$cmd = $pdo->prepare("SELECT e.id_encomenda,e.datadaencomenda,e.NIF_cliente,e.quantidade,c.nome_cliente,p.nome_produto FROM encomendas AS e JOIN produtos AS p ON e.id_produto = p.id_produto JOIN clientes AS c ON e.NIF_cliente = c.NIF_cliente WHERE e.datadaencomenda LIKE :texto OR e.NIF_cliente LIKE :texto OR e.quantidade LIKE :texto OR c.nome_cliente LIKE :texto OR p.nome_produto LIKE :texto");
$cmd->bindValue(':texto', "%" . $_GET['text_input'] . "%");
$cmd->execute();
$res = $cmd->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($res);