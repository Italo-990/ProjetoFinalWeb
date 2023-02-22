<?php

class MinhaLojaOnline{

    private $pdo;

    public function __construct($dbn,$user,$pass)
    {
        try{
            $this->pdo = new PDO($dbn, $user, $pass);
        }catch(PDOException $e){
            echo "Error com banco de dados " . $e->getMessage();
        }catch(Exception $e){
            echo "Erro genérico " . $e->getMessage();
        }
    }

    public function buscarProdutos(){
        $res = array();
        $cmd = $this->pdo->prepare("SELECT * FROM produtos");
        $cmd->execute();
        if($cmd->rowCount() > 0){
            $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }else{
            return false;
        }
    }
    public function inserirClientes($nifcliente,$name,$location,$birthday){
        $cmd = $this->pdo->prepare("SELECT * FROM clientes WHERE NIF_cliente = :NIF_cliente");
        $cmd->bindValue(":NIF_cliente",$nifcliente);
        $cmd->execute();
        if( $cmd->rowCount() > 0){
            
        }else{
            $cmd = $this->pdo->prepare("INSERT INTO clientes(NIF_cliente,nome_cliente,morada,datadenascimento)VALUES(:NIF_cliente,:nome,:morada,:datadenascimento)");
            $cmd->bindValue(":nome", $name);
            $cmd->bindValue(":morada",$location);
            $cmd->bindValue(":datadenascimento", $birthday);
            $cmd->bindValue(":NIF_cliente", $nifcliente);
            $cmd->execute();
        }
    }
    public function buscarClientes(){
        $cmd = $this->pdo->prepare("SELECT * FROM clientes");
        $cmd->execute();
    }
    public function adicionarEncomenda($datadaencomenda,$nifcliente,$id_produto,$quantidadeProdutos){
        $cmd = $this->pdo->prepare("INSERT INTO encomendas(datadaencomenda,NIF_cliente,id_produto,quantidade)VALUES(:datadaencomenda,:NIF_cliente,:id_produto,:quantidade)");
        $cmd->bindValue(":datadaencomenda", $datadaencomenda);
        $cmd->bindValue(":NIF_cliente", $nifcliente);
        $cmd->bindValue(":id_produto", $id_produto);
        $cmd->bindValue(":quantidade", $quantidadeProdutos);
        $cmd->execute();
    }
    public function atualizarEstoque($novoestoque,$id_produto){
        $cmd = $this->pdo->prepare("UPDATE produtos SET emestoque = :emestoque WHERE id_produto = :id_produto");
        $cmd->bindValue(":emestoque", $novoestoque);
        $cmd->bindValue(":id_produto", $id_produto);
        $cmd->execute();
    }
    public function buscarUmProduto($id_produto){
        $res = array();
        $cmd = $this->pdo->prepare("SELECT * FROM produtos WHERE id_produto = :id_produto");
        $cmd->bindValue(":id_produto", $id_produto);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    public function buscarEncomendas(){
        $res = array();
        $cmd = $this->pdo->prepare("SELECT e.id_encomenda,e.datadaencomenda,e.NIF_cliente,e.quantidade,c.nome_cliente,p.nome_produto FROM encomendas AS e JOIN produtos AS p ON e.id_produto = p.id_produto JOIN clientes AS c ON e.NIF_cliente = c.NIF_cliente");
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    public function adminLogin($nameuser,$password){
        $cmd = $this->pdo->prepare("SELECT * FROM utilizadores WHERE nome = :nome AND senha = :senha ");
        $cmd->bindValue(":nome", $nameuser);
        $cmd->bindValue(":senha", $password);
        $cmd->execute();
        if($cmd->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}
