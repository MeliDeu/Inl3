"use strict";
//script för att sköta all fetch med olika https-metoder
//anrop görs via dbhandler.php

//när sidan laddas, hämtas alla paletter från databasen och för varje element appendas det // skapas en ny instans och htmlRender() anropas --> in i lokal array

//GET-förfrågan för att hämta alla users och paletter för att sedan pusha in i respektive globala variabel
let allReq = new Request("api/apiReceiver.php");
fetch(allReq)
  .then(resp => resp.json())
  .then(info => {
    // console.log(info);
    allUsers = info.users.map(user => user)
    palettes = info.palettes.map(palette => palette)
  })

//när inloggad --> vänster #ownPalettes: visar alla paletter som har samma ownerID --> anropar paletteSaved
// höger #allUsersPalettes: visar alla paletter som INTE har samma ownerID som inloggad user --> anropar PaletteOthers


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

    //hämtar in ID för nuvarande inloggad user, som har sparats som ID i span (iom att id inte kan börja med en siffra, så plockas bort det första tecknet)
    let currentUser = $("span.loggedInUser").attr("id");
    let currentUserID = currentUser.substring(1, currentUser.length);

    let highestID = 0;
    palettes.forEach(palette => {
      if (palette["id"] > highestID) {
        highestID = palette["id"];
      }
    });

    let nyPalette = {
        id: highestID+1,
        name: "",
        colors: [],
        creatorID: currentUserID,
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
            nyPalette.name = word.data;
            console.log(nyPalette);
            palettes.push(nyPalette);
            const nyPostReq = new Request("api/apiReceiver.php", {
              method: "POST",
              body: JSON.stringify(nyPalette),
              headers: {"Content-type": "application/json; charset=UTF-8"},
            });
            fetch(nyPostReq)
              .then(res => res.json())
              .then(resurs => {
                console.log(resurs);
              })
          });
    });
}

//on click på addPalette --> fetcha, sätta ihop nytt objekt, in i arrayn och posta upp till databasen
$("#addPalette").on("click", function(){
  getPalette();
})