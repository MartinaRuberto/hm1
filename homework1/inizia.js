button_cerca = document.querySelector('form');
button_cerca.addEventListener('submit', Cerca);

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

function onResult(response) {
    return response.json();

}

function onJsonFinal(json) {
    console.log(json);
    
    if(!json.total_results==0)
    {
       let min = Math.min(6, json.total_results);
       const movie_container = document.querySelector('.container_movie');
       movie_container.innerHTML = '';
       //console.log(json.total_results);

        for (let i = 0; i < min; i++) {
        
        const id = json.results[i].id;
        const movie = json.results[i].name;
        const image = 'https://www.themoviedb.org/t/p/w600_and_h900_bestv2' + json.results[i].poster_path;
        //const overview = json.results[i].overview;

        const container = document.createElement("div");
        const immagine = document.createElement("img");
        const name = document.createElement("strong");
        //const descrizione = document.createElement("p");
        const cuore_vuoto = document.createElement("img");
        const carrello_vuoto = document.createElement("img");
        const optional = document.createElement("div");
        cuore_vuoto.src = "cuore_vuoto.svg";
        carrello_vuoto.src = "bx-save.svg";
        cuore_vuoto.dataset.id = id;
        cuore_vuoto.dataset.title = movie;
        cuore_vuoto.dataset.immagine = image;
        carrello_vuoto.dataset.id = id;
        carrello_vuoto.dataset.title = movie;
        carrello_vuoto.dataset.immagine = image;
        immagine.src = image;
        name.textContent = movie;
        //descrizione.textContent = overview;
        const movie_container = document.querySelector('.container_movie');
//const id = json.results[i].id;cuore_vuoto.dataset.id = id;carrello_vuoto.dataset.id = id;
        container.classList.add('container');
        immagine.classList.add('immagine');
        carrello_vuoto.classList.add('checkbox1');
        cuore_vuoto.classList.add('checkbox2');
        name.classList.add('name');
        //descrizione.classList.add('descrizione');
        optional.classList.add('optional');

        container.appendChild(name);
        container.appendChild(immagine);
        //container.appendChild(descrizione);
        optional.appendChild(cuore_vuoto);
        optional.appendChild(carrello_vuoto);
        container.appendChild(optional);
        movie_container.appendChild(container);
        }
        

        const carrello_vuoto_click = document.querySelectorAll('.checkbox1');
        for (const box of carrello_vuoto_click) {
        box.addEventListener('click', click1);
        }


        function click1(event) {
            const e = event.currentTarget;
           // console.log(e);
            if (e.src.indexOf("bx-save.svg" != -1))
            {
                console.log("prova");
                e.src = 'bxs-save.svg';
                fetch("add_film.php?id=" + e.dataset.id + '&title=' + encodeURIComponent(e.dataset.title) + '&immagine=' + encodeURIComponent(e.dataset.immagine))
                .then(function () {
                    fetch("add_saved.php?id=" + e.dataset.id)
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
              e.src = 'bx-save.svg';
              fetch("remove_film.php?id=" + e.dataset.id + '&title=' + e.dataset.title + '&immagine=' + e.dataset.immagine)

             .then(function () {
              fetch("remove_saved.php?id=" + e.dataset.id)
              });

               e.addEventListener('click', click1);
           }
       


        const cuore_vuoto_click = document.querySelectorAll('.checkbox2');
        for (const box of cuore_vuoto_click) {
        box.addEventListener('click', click2);
        }


        function click2(event)
         {
         const e = event.currentTarget;
          // console.log(e)
             if (e.src.indexOf("cuore_vuoto.svg" != -1)) {
                console.log("prova");
                e.src = 'cuore_pieno.svg';
                fetch("add_film.php?id=" + e.dataset.id + '&title=' + encodeURIComponent(e.dataset.title) + '&immagine=' + encodeURIComponent(e.dataset.immagine))

                .then(function () {
                    fetch("add_like.php?id=" + e.dataset.id)
                });
                e.addEventListener('click', click3);
                e.removeEventListener('click', click2)

             }
              else
               {
                click3(e);
               }
        }


           function click3(event) {

        const e = event.currentTarget;
        e.src = 'cuore_vuoto.svg';
        fetch("remove_like.php?id=" + e.dataset.id) 
    
            .then(function () {
                fetch("remove_film.php?id=" + e.dataset.id + '&title=' + encodeURIComponent(e.dataset.title) + '&immagine=' + encodeURIComponent(e.dataset.immagine))
            });
    
            //click2(e);
            e.addEventListener('click', click2);
          }
    
    }else{
        const movie_container = document.querySelector('.container_movie');

        movie_container.innerHTML = '';
        
        const not_found=document.createElement('p');
        not_found.textContent="Nessun risultato";
        not_found.classList.add('not_found');
        movie_container.appendChild(not_found);
    }
}




function Cerca(event) {
    event.preventDefault();
    const text = document.querySelector('#series').value;
    const encodedText = encodeURIComponent(text);

    fetch('fetch_inizia.php?series=' + encodedText)
        .then(onResult).then(onJsonFinal);
 
}


//https://api.themoviedb.org/3/search/tv?api_key=c2b1b963519f2015731940ea8ae37250&query=
