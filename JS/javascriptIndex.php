<script>
var res = <?php print_r(json_encode($res));?>
</script>
<script>
const inputAdquirir = document.querySelectorAll('.inputadquirir')
var valorFinalInput = 0
var validar = Array()
let somar = Array()
let test = Array()
for(let i = 0; i < inputAdquirir.length;i++){
    inputAdquirir[i].addEventListener("change",()=>{
        if(inputAdquirir[i].value < 0){
            validar[i] = false;
            alert('Valor Invalido')
         }else if(inputAdquirir[i].value > Number(res[i]['emestoque'])){
            validar[i] = false;
            alert('Quantidade maior que disponivel em estoque')
         }else{
            somar[i] = Number(inputAdquirir[i].value) * Number(res[i]['valorproduto'])
            validar[i] = true;
            valorFinal()
         }})
}
document.getElementById('buybutton').addEventListener("click",(e)=>{
    e.preventDefault()
    let validacao = (currentValue) => currentValue == true
    if(validar.every(validacao) && valorFinalInput > 0){
        document.getElementById('buyProducts').submit()
    }else{
        alert('Erro em algum campo')
    }
})
function valorFinal(){
    valorFinalInput = somar.reduce(function(soma,i){
        return soma + i;
    })
    document.getElementById('inputvalorfinal').value = Number(valorFinalInput)
}
</script>