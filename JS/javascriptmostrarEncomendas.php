<script>
var res = <?php echo json_encode($res)?>
</script>
<script>
const tdbody = document.getElementById('tdbody')
const titulos = ` <tr class='tr_title'>
                    <th>Nif Cliente</th>
                    <th>Nome</th>
                    <th>Produto</th>
                    <th>Quantidades Encomendadas</th>
                    <th>Data da Encomenda</th>
                    <th></th>
                    </tr>`


//-------------------------------------CONST------------------------------//
if(res.length == 0){
    tdbody.innerHTML = '<p>Sem encomendas pendentes<p>';
}else{
    let texto = ''
    for(let i = 0; i < res.length; i++){
        texto += `<tr class='produtos_tr'>
                  <td>${res[i]['NIF_cliente']}</td>
                  <td>${res[i]['nome_cliente']}</td>
                   <td>${res[i]['nome_produto']}</td>
                   <td>${res[i]['quantidade']}</td>
                   <td>${res[i]['datadaencomenda']}</td>
                   <td><button class='delete_produtos' value='${res[i]['id_encomenda']}'><i class="fa-solid fa-trash"></i></button></td>
                   `
    }
    tdbody.innerHTML += texto
    eventDelete()
}
document.getElementById('input_search').addEventListener('keyup',()=>{
    $.ajax({
        url:'AJAX/procurarEncomendas.php',
        method:'GET',
        data:{text_input: document.getElementById('input_search').value},
        dataType:'json'
    }).done(function(res){
        if(res == 0){
            tdbody.innerHTML = 'Sem encomendas encontradas'
        }else{
            let texto = ''
            for(let i = 0; i < res.length;i++){
                texto += `<tr class='produtos_tr'>
                  <td>${res[i]['NIF_cliente']}</td>
                  <td>${res[i]['nome_cliente']}</td>
                   <td>${res[i]['nome_produto']}</td>
                   <td>${res[i]['quantidade']}</td>
                   <td>${res[i]['datadaencomenda']}</td>
                   <td><button class='delete_produtos' value='${res[i]['id_encomenda']}'><i class="fa-solid fa-trash"></i></button></td>
                   </tr>`
            }
    tdbody.innerHTML = titulos + texto
    eventDelete()
        }
    }).fail(function(error){
        alert('Erro com AJAX olhar console')
        console.log(error)
    })
})
function eventDelete(){
const delete_button = document.querySelectorAll('.delete_produtos')
for(let i = 0; i < delete_button.length; i++){
    delete_button[i].addEventListener('click',()=>{
        if(confirm('Tem a certeza que deseja deletar esta encomenda?')){
            $.ajax({
                url:'AJAX/deletarEncomenda.php',
                method:'GET',
                data:{id_encomenda: delete_button[i].value},
                success: function(){
                    $.ajax({
                        url:'AJAX/mostrarEncomendas.php',
                        dataType:'json'
                    }).done(function(res){
                        if(res == 0){
                            tdbody.innerHTML = 'Sem encomendas pendentes';
                        }else{
                            let texto = ''
                            for(let i = 0; i < res.length;i++){
                            texto += `<tr class='produtos_tr'>
                                      <td>${res[i]['NIF_cliente']}</td>
                                      <td>${res[i]['nome_cliente']}</td>
                                      <td>${res[i]['nome_produto']}</td>
                                      <td>${res[i]['quantidade']}</td>
                                      <td>${res[i]['datadaencomenda']}</td>
                                      <td><button class='delete_produtos' value='${res[i]['id_encomenda']}'><i class="fa-solid fa-trash"></i></button></td>
                                      </tr>`
                        }
                        tdbody.innerHTML = titulos + texto
                        document.getElementById('input_search').value = ''
                        eventDelete()
                        }
                    }).fail(function(error){
                        alert('Erro com AJAX olhar console')
                        consle.log(error)
                    })
                }
            }).fail(function(error){
                alert('Erro com AJAX olhar console!')
                console.log(error)
            })
        }
    })
}
}
</script>