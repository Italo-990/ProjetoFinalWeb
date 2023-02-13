<?php
if (!isset($_SESSION)) {
    session_start();
}
require 'classesphp/classMinhaLoja.php';
$p = new MinhaLojaOnline('mysql:host=localhost;dbname=minhalojaonline', 'root', '');
$res = $p->buscarProdutos();
$quantidadeProdutos = array();
$nomeProdutos = array();
$valorCadaProdutoEscolhido = array();
$valorProdutos = array();
$valorFinal = 0;
for($i = 0;$i < count($res);$i++){
    if (isset($_POST[$res[$i]['id_produto']])){
     if($_POST[$res[$i]['id_produto']] > 0){
        $_SESSION['quantidadeProduto'][$i] = $_POST[$res[$i]['id_produto']];
        $nomeProdutos[$i] = $res[$i]['nome_produto'];
        $valorProdutos[$i] = $res[$i]['valorproduto'];
        $valorCadaProdutoEscolhido[$i] = $valorProdutos[$i] * $_SESSION['quantidadeProduto'][$i];
        $valorFinal += $valorCadaProdutoEscolhido[$i];
    }
    } }
    if(count($_SESSION['quantidadeProduto']) == 0){
        header("location:index.php");
    }
?>
<?php
if (isset($_POST['nameuser'])) {
        $nameuser = addslashes($_POST['nameuser']);
        $locationuser = addslashes($_POST['locationuser']);
        $datadenascimento = addslashes($_POST['birthdayuser']);
        $nifuser = addslashes($_POST['NIFuser']);
        $today = date("Y/m/d");
        $regInjec = "/[;',()*@#$%&<>\/]/";
        $regNumber = "/[0-9]/";
        //----------------------------------VALIDAÇÃO BACK END---------------------------------------------
        if (
            empty($nameuser) || empty($locationuser) || empty($datadenascimento) || preg_match(
                $regInjec,
                $nameuser
            ) || preg_match(
                $regInjec,
                $locationuser
            )
            || preg_match(
                $regInjec,
                $datadenascimento
            ) || preg_match(
                $regNumber,
                $nameuser
            ) || preg_match(
                $regInjec,
                $nifuser
            )
        ) {
            die('Error');
        } else {
            $p->inserirClientes($nifuser, $nameuser, $locationuser, $datadenascimento);
            $_SESSION['nifuser'] = $nifuser;
            $_SESSION['today'] = $today;
            header("location:adicionarCompra.php");
        }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='css/cssConfirmarCompra.css' rel="stylesheet">
    <title>Confirmar compra</title>
</head>
<body>
<button id='button_voltar'><a href='index.php'>Voltar</a></button>
    <form id='form' method='POST' autocomplete="off">
        <div class='form'>
            <h1>Insira seus dados</h1>
        <div class="form-control">
            <div class='label-control'><label for='nameuser'>Nome</label></div>
            <input type='text' name='nameuser' id='nameuser'>
            <span>Error</span>
        </div>
        <div class="form-control">
        <div class='label-control'><label for='locationuser'>Morada</label></div>
            <input type='text' name='locationuser' id='locationuser'>
            <span>Error</span>
        </div>
        <div class="form-control">
        <div class='label-control'><label for='birthdayuser'>Data de nascimento</label></div>
            <input type='date'name='birthdayuser' id='birthdayuser'>
            <span>Error</span>
        </div>
        <div class="form-control">
        <div class='label-control'><label for='NIFuser'>NIF</label></div>
            <input type='text'name='NIFuser' id='NIFuser'>
            <span>Error</span>
        </div>
        <div class='produtos-control'>
            <h2>Produtos escolhidos</h2>
            <?php
            for ($i = 0; $i < count($res); $i++) {
                if (isset($nomeProdutos[$i])) { ?><p><?php echo $nomeProdutos[$i]; ?> (<?php echo $valorProdutos[$i] ?>€) - <?php echo $_SESSION['quantidadeProduto'][$i];?>x = <?php echo $valorCadaProdutoEscolhido[$i]?>€</p><?php
                }
            }
            ?>
            <p>Valor final : <?php echo $valorFinal ?>€</p>
        </div>
        <div class="button-control">
            <input type='submit' class='button_submit' id='button_submit' value='Confirmar compra'>
        </div>
    </form>
    <script src='JS/javascriptConfirmarCompra.js'></script>
</body>
</html>
