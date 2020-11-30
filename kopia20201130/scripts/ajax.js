"use strict";
//script för att sköta all fetch med olika https-metoder
//anrop görs via dbhandler.php

//när sidan laddas, hämtas alla paletter från databasen och för varje element appendas det // skapas en ny instans och htmlRender() anropas --> in i lokal array

//GET-förfrågan för att hämta alla users och paletter för att sedan pusha in i respektive globala variabel
let allReq = new Request("../api/apiReceiver.php");
fetch(allReq)
  .then(resp => resp.json())
  .then(info => {
    // console.log(info);
    allUsers = info.users.map(user => user)
    palettes = info.palettes.map(palette => palette)
  })

//när inloggad --> vänster #ownPalettes: visar alla paletter som har samma ownerID --> anropar paletteSaved
// höger #allUsersPalettes: visar alla paletter som INTE har samma ownerID som inloggad user --> anropar PaletteOthers

//on klick (add) --> ny request till både Eriks API och färgAPI, sedan läggs de ihop till ett objekt som skickas till databasen med POST (även annan info) --> nytt objekt även instoppat i arrayn --> appendas enl.sortfunktionen med animation

// länkar
//"http://colormind.io/api/"

//https://erikpineiro.se/dbp/nouns/api.php



//anropas på click on "lägga till ny palette"
function getPalette(){
    const url = "http://colormind.io/api/";
    //krävs av API:n att skickas med
    let data = {
        model: "default"
    }

    let nRequest = new Request(url, {
        method: "POST",
        body: JSON.stringify(data)
    });

    let nyPalette = {
        id: "",
        name: "",
        colors: [],
        creatorID: findCreatorIDbyName(allUsers, $("")),
        date: now
    };

    fetch(nRequest)
    .then(res => res.json())
    .then(resurs => {
        //här hämtar vi in paletten, men vi måste göra ytterligare en fetch till eriks API för att få ett namn, tillsammans med paletten, datum mm ska det sedan sättas ihop till ett objekt och postas till DB
        //arrayn med färgerna ligger i key:n result :)
        resurs.result.forEach(color => {
          nyPalette.colors.push(color); 
        });
        
        const wordRequest = new Request("https://erikpineiro.se/dbp/nouns/api.php");
        fetch(wordRequest)
          .then(resp => resp.json())
          .then(word => {
            //kommer med property "data"
            // console.log(word);
            nyPalette.name = word.data;
            console.log(nyPalette);
          });
    })
}


getPalette();