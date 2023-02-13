const nome_produto = document.getElementById('nome_produto')
const preco_produto = document.getElementById('preco_produto')
const em_estoque  = document.getElementById('em_estoque')
const link_imagem = document.getElementById('link_imagem')
function onloadBody(){
    nome_produto.value = document.getElementById('nome_produto_visualizacao').innerHTML
    preco_produto.value = document.getElementById('valor_produto_visualizacao').innerHTML
    em_estoque.value = document.getElementById('inputemestoque').value
    link_imagem.value = document.getElementById('imagem_produto_visualizacao').getAttribute('src')
}
//-----------------------------EVENTS PRÉ VISUALIZAÇÃO------------------------------------------
nome_produto.addEventListener('keyup',()=>{
    document.getElementById('nome_produto_visualizacao').innerHTML = nome_produto.value
})
preco_produto.addEventListener('keyup',()=>{
    document.getElementById('valor_produto_visualizacao').innerHTML = preco_produto.value
})
em_estoque.addEventListener('keyup',()=>{
    document.getElementById('inputemestoque').value = em_estoque.value
})
link_imagem.addEventListener('change',()=>{
    document.getElementById('imagem_produto_visualizacao').setAttribute('src', link_imagem.value)
})
//-------------------------------FIM FIM PRÉ VISUALIZAÇÃO----------------------------------------------
document.getElementById('atualizar_produtos_submit').addEventListener('click',(e)=>{
    e.preventDefault()
    if(confirm('Tem a certeza que deseja fazer a atualização deste produto?')){
        $.ajax({
            url:'AJAX/atualizarProdutos.php',
            method:'GET',
            data:{id_produto: document.getElementById('produto_id').innerHTML, nome: nome_produto.value,
                    preco_produto: preco_produto.value, link_imagem: link_imagem.value, em_estoque: em_estoque.value },
            success: function(){
                alert('Produto atualizado com sucesso!')
            }
        }).fail(function(error){
            alert('Error com AJAX olhar console')
            console.log(error)
        })
    }
})