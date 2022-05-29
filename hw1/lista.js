

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

function response(response) {
  
    return response.json();
}

function json(json) {

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
        const carrello_vuoto = document.createElement("img");
        const optional = document.createElement("div");

       
        carrello_vuoto.src = "bxs-save.svg";
        immagine.src = image;
        nome.textContent = movie;
        carrello_vuoto.dataset.id = id;
        carrello_vuoto.dataset.title = movie;
        carrello_vuoto.dataset.immagine = image;
        


        container.classList.add('container');
        immagine.classList.add('immagine');
        nome.classList.add('name');
        carrello_vuoto.classList.add('checkbox1');
        optional.classList.add('optional');


        container.appendChild(nome);
        container.appendChild(immagine);
        optional.appendChild(carrello_vuoto);
        container.appendChild(optional);
        movie_container.appendChild(container);

    }
       const carrello_vuoto_click = document.querySelectorAll('.checkbox1');
       for (const box of carrello_vuoto_click)
        {
         box.addEventListener('click', click1);
        }


        function click1(event)
        {
           const e = event.currentTarget;
           
            if (e.src.indexOf("bxs-save.svg" != -1))
            {
                console.log("prova");
                e.src = 'bx-save.svg';
                fetch("remove_saved.php?id=" + e.dataset.id)

                    .then(function ()
                     {
                       fetch("remove_film.php?id=" + e.dataset.id + '&title=' + e.dataset.title + '&immagine=' + e.dataset.immagine)
                       .then(function(){
                        movie_container.innerHTML='';
                        fetch_load_home_saved();
                         }); 
                     });
                           e.addEventListener('click', click4);
                           e.removeEventListener('click', click1)

            }else
            {
             click4(e);
            }
        }


             function click4(event)
             {

               const e = event.currentTarget;
               e.src = 'bxs-save.svg';
               fetch("add_film.php?id=" + e.dataset.id + '&title=' + e.dataset.title + '&immagine=' + e.dataset.immagine)

              .then(function () {
               fetch("add_saved.php?id=" + e.dataset.id)
               });

                e.addEventListener('click', click1);
            }


}

function fetch_load_home_saved() {
   
    fetch("getLista.php").then(response).then(json);

}

fetch_load_home_saved();