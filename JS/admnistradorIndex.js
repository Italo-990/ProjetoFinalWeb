//---------------------------------VARIVEIS GLOBAIS------------------------------------------
const deleteProduto = $(".delete_produtos")
const div_produtos = document.getElementById('produtos')
const deslogar_link = document.getElementById('deslogar_link')
//-------------------------------FIM VARIABEIS GLOBAIS--------------------------------------
//--------------------------------EVENT DELETE---------------------------------------------
for(let i = 0; i < deleteProduto.length;i++){
    deleteProduto[i].addEventListener('click',(e)=>{
        e.preventDefault()
        if(confirm("Tem a certeza que deseja excluir este produto?")){
            let deletar = deleteProduto[i].value
        $.ajax({
            url:'AJAX/deletarProduto.php',
            method:"GET",
            data: {delete: deletar},
        }).done(function(result){
            if(result == 0){
                alert('Há encomendas pendentes deste produto')
            }else{
                    alert('Produto excluido com sucesso!')
                    window.location = 'admnistradorIndex.php'
            }
        }).fail(function(error){
            alert('Erro com requisição ajax, olhar console')
            console.log(error)
        })
}})
}
//----------------------------------FIM DELETE------------------------------------------------
deslogar_link.addEventListener('click',()=>{
    if(confirm('Tem a certeza que deseja fazer o logout?')){
        window.location = "?logout"
    }
})
