//---------------------------------------------------------------------
const nome_produto = document.getElementById('nome_produto')
const preco_produto = document.getElementById('preco_produto')
const em_estoque  = document.getElementById('em_estoque')
const link_imagem = document.getElementById('link_imagem')
//-----------------------------CONST------------------------------------
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
    document.getElementById('imagem_produto_visualizacao').setAttribute('src',link_imagem.value)
})

document.getElementById('adicionar_produtos_submit').addEventListener('click',(e)=>{
    e.preventDefault()
    if(confirm("Tem a certeza que deseja adicionar este produto?")){
        $.ajax({
            url:'AJAX/adicionarProdutos.php',
            method:'GET',
            data:{nome:nome_produto.value , imagem:link_imagem.value ,valorproduto: preco_produto.value, emestoque: em_estoque.value},
            success: function(){
                alert('Produto adicionado com sucesso!')
                nome_produto.value = '';
                preco_produto.value = '';
                link_imagem.value = '';
                em_estoque.value = '';
            }
        }).done(function(result){
            console.log(result)
        }).fail(function(error){
            alert('Erro com AJAX olhar console')
            console.log(error)
        })
    }
})