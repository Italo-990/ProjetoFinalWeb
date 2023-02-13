<?php
if(!isset($_SESSION)){
  session_start();
}
if(isset($_SESSION['adminUser'])){
  $salvaradmin = $_SESSION['adminUser'];
  $_SESSION = array();
  $_SESSION['adminUser'] = $salvaradmin;
}else{
  $_SESSION = array();
}
require "classesphp/classMinhaLoja.php";
$produc = new MinhaLojaOnline("mysql:host=localhost;dbname=minhalojaonline", "root", "");
$res = $produc->buscarProdutos();
?>
<?php
/*
------------------------------------VALIDACAO BACK-END--------------------------------------
*/
$produtosEscolhidos = array();
$regInjec = "/[;',()*@#$%&<>\/]/";
  for($i = 0; $i < count($res);$i++){
    if(isset($_POST[$res[$i]['id_produto']])){
    $produtosEscolhidos[$i] = $_POST[$res[$i]['id_produto']];
    if($produtosEscolhidos[$i] < 0 || $produtosEscolhidos[$i] > $res[$i]['emestoque'] || preg_match($regInjec,$produtosEscolhidos[$i])){
      die('Error');
    }
  }
}
/*
--------------------------------------------------------------------------------------------
*/
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/cssIndex.css">
  <title>Comprar produtos</title>
</head>
<body>
  <form id='buyProducts' method="POST" action='confirmarCompra.php'>
  <div class='produtos' id='produtos'>
    <?php
    for ($i = 0; $i < count($res); $i++) {
      ?><div class ='divprodutos'>
      <h2><?php echo $res[$i]['nome_produto'] ?> - <?php echo $res[$i]['valorproduto']; ?>€</h2>
      <div class='divimg'><img src=<?php echo $res[$i]['imagem']?>></img></div>
      <p>Quantidade em estoque : <input class='inputemestoque'type='number' disabled value="<?php echo $res[$i]['emestoque']?>"></p>
      <p>Quantidade que quero adquirir: <input class='inputadquirir <?php if ($res[$i]['emestoque'] == 0) {echo 'sem_estoque';}?>'name ="<?php echo $res[$i]['id_produto'] ?>" type="number" <?php if ($res[$i]['emestoque'] == 0) {echo 'disabled';}?>>
      </div><?php
    }?>
  </div>
  <div class='valorfinal-control'>
    <p>Sub-Total : <input id = 'inputvalorfinal' type='number' readonly></p>
    <div class='divsubmit'><input id='buybutton'type="submit" value="Comprar"></div>
    <button><a href='adminLogin.php'>Administração</a></button>
  </div>
  </form>
  <?php
  include 'JS/javascriptIndex.php'; 
  ?>
</body>
</html>