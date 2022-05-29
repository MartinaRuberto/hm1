const username=document.querySelector('input[name="Username"]');
username.addEventListener('blur',checkusername);

function onResponse(response) {
    console.log('response');
    return response.json();
}

function onJson(json,e){
console.log(json);
const errore=e.parentNode.querySelector('span');
console.log(username.value);
console.log(json[0].username);
if(username.value!==json[0].username){
    
    errore.textContent="username errato";
    errore.classList.add("errore");
}
else{

    errore.textContent='';
    errore.classList.remove("errore");
}
}



function checkusername(event){
const e=event.currentTarget;
console.log(e.value);
const errore=e.parentNode.querySelector('span');
if(e.value.length===0){

    errore.textContent="inserire username";
    errore.classList.add("errore");
    
}else{
    errore.textContent='';
    errore.classList.remove("errore");
    fetch("CheckUsername.php?Username="+username.value).then(onResponse).then(
        function(json){
            return onJson(json, e)
        });
        

}
  
}
  
const password=document.querySelector('input[name="Password"]');
password.addEventListener('blur',checkpassword);

function checkpassword(event){
const e=event.currentTarget;
console.log(e.value);
if(e.value.length===0){

    const errore=e.parentNode.querySelector('span');
    errore.textContent="inserire password";
    errore.classList.add("errore");
    
}


}
      





