<?php
if (!isset($_SESSION)) {
    session_start();
}
if(!isset($_SESSION['quantidadeProduto'])){
    header("location:index.php");
}

require 'classesphp/classMinhaLoja.php';
$p = new MinhaLojaOnline('mysql:host=localhost;dbname=minhalojaonline', 'root', '');
$res = $p->buscarProdutos();
for($i = 0; $i < count($res);$i++){
    if(isset($_SESSION['quantidadeProduto'][$i])){
        $p->adicionarEncomenda($_SESSION['today'], $_SESSION['nifuser'], $res[$i]['id_produto'],$_SESSION['quantidadeProduto'][$i]);
        $valornovoestoque = intval($res[$i]['emestoque']) - intval($_SESSION['quantidadeProduto'][$i]);
        $p->atualizarEstoque($valornovoestoque, $res[$i]['id_produto']);
    }
}
$_SESSION = array();
header("location:index.php");
