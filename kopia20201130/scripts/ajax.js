"use strict";
//script för att sköta all fetch med olika https-metoder
//anrop görs via dbhandler.php
//när sidan laddas, hämtas alla paletter från databasen och för varje element appendas det // skapas en ny instans och htmlRender() anropas --> in i lokal array
//users hämtas också och pushas in i lokal array

//när inloggad --> vänster #ownPalettes: visar alla paletter som har samma ownerID --> anropar paletteSaved
// höger #allUsersPalettes: visar alla paletter som INTE har samma ownerID som inloggad user --> anropar PaletteOthers

//on klick (add) --> ny request till både Eriks API och färgAPI, sedan läggs de ihop till ett objekt som skickas till databasen med POST (även annan info) --> nytt objekt även instoppat i arrayn --> appendas enl.sortfunktionen med animation



