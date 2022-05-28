

const bottone=document.querySelector('#menu');
bottone.addEventListener('click',mobilemenu);

function mobilemenu(event){
    
    const mobile=document.querySelector('.links_mobile');
    mobile.classList.remove('hidden');
    mobile.classList.add('mobile');
    document.body.classList.add('no-scroll');
    const e=event.currentTarget;
    const no_mobile=document.querySelector('.links_mobile.mobile');
    no_mobile.addEventListener('click',no_mobil);
    e.removeEventListener('click',mobilemenu);
    
}

function no_mobil(event){
    const e=event.currentTarget;
    e.classList.add('hidden');
    e.classList.remove('mobile');
    const bottone=document.querySelector('#menu');
    bottone.addEventListener('click',mobilemenu);
}


function onResponse(response) {
    
    return response.json();
}

function onJson(json) {

    //console.log(json);
    const movie_container = document.querySelector('.container_movie');
    //console.log(movie_container);
    for (let i = 0; i < json.length; i++) {
        const id = json[i].id;
        const movie = json[i].title
        const image = json[i].immagine


        const container = document.createElement("div");
        const immagine = document.createElement("img");
        const nome = document.createElement("strong");
        const cuore_vuoto = document.createElement("img");
        const optional = document.createElement("div");

        cuore_vuoto.src = "cuore_pieno.svg";
        immagine.src = image;
        nome.textContent = movie;
        cuore_vuoto.dataset.id = id;
        cuore_vuoto.dataset.title = movie;
        cuore_vuoto.dataset.immagine = image;
        
        container.classList.add('container');
        immagine.classList.add('immagine');
        nome.classList.add('name');
        cuore_vuoto.classList.add('checkbox2');
        optional.classList.add('optional');


        container.appendChild(nome);
        container.appendChild(immagine);
        optional.appendChild(cuore_vuoto);
        container.appendChild(optional);
        movie_container.appendChild(container);

    }
       
    const cuore_vuoto_click = document.querySelectorAll('.checkbox2');
    for (const box of cuore_vuoto_click) {
        box.addEventListener('click', click2);
    }


    function click2(event)
     {
        const e = event.currentTarget;
        //console.log(e)
        if (e.src.indexOf("cuore_pieno.svg" != -1))
         {
            console.log("prova");
            e.src = 'cuore_vuoto.svg';
            fetch("remove_like.php?id=" + e.dataset.id)

                .then(function ()
                 {
                    fetch("remove_film.php?id=" + e.dataset.id + '&title=' + e.dataset.title + '&immagine=' + e.dataset.immagine)
                     .then(function(){
                         movie_container.innerHTML='';
                         fetch_load_home();
                         
                         
                     }); 
                 });
                      e.addEventListener('click', click3);
                      e.removeEventListener('click', click2)

         } else{
           click3(e);
             }
    }

    function click3(event) 
    {

        const e = event.currentTarget;
        e.src = 'cuore_pieno.svg';
        fetch("add_film.php?id=" + e.dataset.id + '&title=' + e.dataset.title + '&immagine=' + e.dataset.immagine)
    
            .then(function () {
                fetch("add_like.php?id=" + e.dataset.id)
            });
    
        //click2(e);
        e.addEventListener('click', click2);
    }
}
    

//fa una fetch alla getpreferiti.php 
function fetch_load_home() {
    console.log('bho');
    fetch("getpreferiti.php").then(onResponse).then(onJson);

}

fetch_load_home();