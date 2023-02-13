<?php
require 'classesphp/classMinhaLoja.php';
$p = new MinhaLojaOnline('mysql:host=localhost;dbname=minhalojaonline', 'root', '');
?>
<?php
if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['adminUser'])){
    header("location:admnistradorIndex.php");
}
if(isset($_POST['nameuser'])){
    $nameuser = str_replace(" ", "", $_POST['nameuser']);
    $password = str_replace(" ","",$_POST['password']);
    $regInjec = "/[<>!;=@#$%*().,¨:\|\=?']/";
    if(empty($nameuser) || empty($password) || preg_match($regInjec,$password) || preg_match($regInjec,$nameuser)){
        die("Error");
    }else{
        if($p->adminLogin($nameuser, $password)){
            $_SESSION['adminUser'] = $nameuser;
            header("location:admnistradorIndex.php");
        }else{
            ?><script>alert('Conta não cadastrada!')</script><?php
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='css/cssAdminLogin.css' rel='stylesheet'>
    <title>Fazer Login Admnistrador</title>
</head>
<body>
<button id='button_voltar'><a href='index.php'>Voltar</a></button>
<form id='form' method='POST' autocomplete="off">
    <div class='form' method='POST'>
        <h1>Fazer Login</h1>
        <div class="form-control">
            <div class='label-control'>
                <label for='nameuser'>Login</label><input type='text' name='nameuser' id='nameuser'>
            </div>
        </div>
        <div class="form-control">
            <div class='label-control'>
                <label for='password'>Senha</label><input type='password' name='password' id='password'>
            </div>
        </div>
        <div class='submit-control'>
            <input type='submit' id='submit_button' value='Login'>
        </div>
    </div>
</form>
</body>
</html>
<script>
    const label_input = document.querySelectorAll('label')
    const nameuser = document.getElementById('nameuser')
    const password = document.getElementById('password')
    nameuser.addEventListener('keyup',()=>{
        if(nameuser.value == ''){
            label_input[0].classList.remove('focus')
        }else{
            label_input[0].classList.add('focus')
        }
    })
    password.addEventListener('keyup',()=>{
        if(password.value == ''){
            label_input[1].classList.remove('focus')
        }else{
            label_input[1].classList.add('focus')
        }
    })
    document.getElementById('submit_button').addEventListener('click',(e)=>{
        e.preventDefault()
        if(nameuser.value == "" || password.value == ""){
            alert('Não pode conter espaços em brancos!')
        }else{
            document.getElementById('form').submit()
        }
        
    })
</script>