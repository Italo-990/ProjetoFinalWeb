<?php
require 'classesphp/classMinhaLoja.php';
$p = new MinhaLojaOnline('mysql:host=localhost;dbname=minhalojaonline', 'root', '');
$res = $p->buscarEncomendas();
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/bfdaeb0ad2.js" crossorigin="anonymous"></script>
    <link href="css/cssMostrarEncomendas.css" rel='stylesheet'>
    <title>Mostrar encomendas</title>
</head>
<body>
<button id='button_voltar'><a href='admnistradorIndex.php'>Voltar</a></button>
<div class='div_principal'>
        <h1>Encomendas</h1>
        <div>
            <p>Fazer pesquisas de encomendas</p>
            <input type='text' id='input_search'>
        </div>
        <div class='div_table'>
            <table class='table_content'>
                <tbody id='tdbody'>
                    <tr class='tr_title'>
                        <th>Nif Cliente</th>
                        <th>Nome</th>
                        <th>Produto</th>
                        <th>Quantidades Encomendadas</th>
                        <th>Data da Encomenda</th>
                        <th></th>
                    </tr>
                    <!------------JAVASCRIPT------------------->
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php
include 'JS/javascriptmostrarEncomendas.php';
?>