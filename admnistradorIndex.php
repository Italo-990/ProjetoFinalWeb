<?php
require 'classesphp/classMinhaLoja.php';
$p = new MinhaLojaOnline('mysql:host=localhost;dbname=minhalojaonline', 'root', '');
$res = $p->buscarProdutos();
$resCount = (is_array($res) ? count($res) : 0);
?>
<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['adminUser'])){
    header("location:adminLogin.php");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/bfdaeb0ad2.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="css/admnistradorIndex.css" rel='stylesheet'>
    <title>Admnistrador pagina principal</title>
</head>
<body>
<button id='adicionar_produto'><a href='adicionarProdutos.php'>Adicionar Produtos </a></button>
<button id='ver_encomendas'><a href='mostrarEncomendas.php'>Ver encomendas</a></button>
<button id='deslogar'><a id='deslogar_link'>Deslogar</a></button>
    <div class='div_principal'>
        <h1>Produtos</h1>
        <div class='div_table'>
            <table class='table_content'>
                <tr class='tr_title'>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php
                if($resCount == 0){
                    echo "<p class='sem_produtos'>Sem produtos cadastrados</p>";
                }else{
                    for($i = 0; $i < count($res);$i++){
                        ?><tr class='produtos_tr'>
                            <td><?php echo $res[$i]['nome_produto'];?></td>
                            <td><?php echo $res[$i]['valorproduto'];?>€</td>
                            <td><?php echo $res[$i]['emestoque'];?></td>
                            <td><a href="editarProduto.php?id_produto=<?php echo $res[$i]['id_produto'];?>"><i class="button_td fa-solid fa-pen-to-square"></i></a></td>
                            <td><button class='delete_produtos' value='<?php echo $res[$i]['id_produto'];?>'><i class="button_td fa-solid fa-trash"></i></button></td>
                          </tr><?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
    <script src='JS/admnistradorIndex.js'></script>
</body>
</html>
<?php
if(isset($_GET['logout'])){
    session_destroy();
    header("location:adminLogin.php");
}
?>