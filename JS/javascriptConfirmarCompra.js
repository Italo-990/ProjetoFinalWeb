const nameuser = document.getElementById('nameuser')
const locationuser = document.getElementById('locationuser')
const birthdayuser = document.getElementById('birthdayuser')
const nifUser = document.getElementById('NIFuser')
const regExNumber = /[0-9]/
const regInjec = /[<>?@#"';,%&$*!?+=():]/
//------------------------------PREVENT SUBMIT---------------------------------------------
document.getElementById('button_submit').addEventListener('click',(e)=>{
    e.preventDefault()
    if(checkInput()){
        document.getElementById('form').submit()
        alert('Compra efetudada com sucesso!')
    }else{
        alert('Erro em algum campo')
    }
})
//-----------------------------------------------------------------------------------------
//----------------------------------EVENTS-------------------------------------------
nameuser.addEventListener('change',nameValidation)
locationuser.addEventListener('change',locationValidation)
birthdayuser.addEventListener('change',birthdayuserValidation)
nifUser.addEventListener('change',nifUserValidation)
//-------------------------------FIM EVENTS-----------------------------------------------
//---------------------------------FUNCTIONS----------------------------------------------
function nameValidation(){
    if(nameuser.value == ''){
        errorValidation(nameuser,"Preencha esse campo")
        return false;
    }else if(regExNumber.test(nameuser.value) || regInjec.test(nameuser.value)){
        errorValidation(nameuser,"Nome invalido")
        return false;
    }else{
        successValidation(nameuser)
        return true;
    }
}

function locationValidation(){
    if(locationuser.value == ""){
        errorValidation(locationuser,"Preencha esse campo")
        return false;
    }else if(regInjec.test(locationuser.value)){
        errorValidation(locationuser,"Morada invalida")
        return false;
    }else{
        successValidation(locationuser)
        return true;
    }
}
function birthdayuserValidation(){
    const now = new Date()
    let birthdayuserArray = birthdayuser.value.split('');
    let yearUserArray = []
    var yearUser = ''
    for(let i = 0; i < 4;i++){
        yearUserArray[i] = birthdayuserArray[i]
    }
    for(let i = 0; i < yearUserArray.length;i++){
        yearUser += yearUserArray[i]
    }
    if((now.getFullYear() - Number(yearUser)) < 18 || (now.getFullYear() - Number(yearUser)) > 100){
        errorValidation(birthdayuser,"Data invalida")
        return false;
    }else if(birthdayuser.value == ""){
        errorValidation(birthdayuser,"Preencha esse campo")
        return false;
    }else{
        successValidation(birthdayuser)
        return true;
    }
}

function nifUserValidation(){
    if(nifUser.value == ""){
        errorValidation(nifUser,"Preencha esse campo")
        return false
    }else if(nifUser.value.length != 9){
        errorValidation(nifUser,"Nif invalido")
        return false
    }else{
        successValidation(nifUser)
        return true
    }
}

function checkInput(){
    if(nameValidation() && locationValidation() && birthdayuserValidation() && nifUserValidation()){
        return true;
    }else{
        return false;
    }
}
function errorValidation(input,message){
    let divInput = input.parentNode
    let span = divInput.children[2]
    span.innerText = message
    span.className = 'error'
}
function successValidation(input){
    let divInput = input.parentNode
    divInput.children[2].classList.remove("error")
}