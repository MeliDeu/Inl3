"use strict";

//här har vi alla våra classconstructors.. vi skickar en get-förfrågan till bågge api i ajax.js och pysslar ihop ett objekt med alla properties, som vi sedan skapar instanser med, dessa skickas sedan med POST  till databasen och samtidigt pushas in i vår palettes-array i data.js

class PaletteBase {
    constructor(data) {
        this.id = data.id;
        this.name = data.name;
        this.colors = data.colors;
        //container där vi placerar allt sedan / kanske false från början? kolla på athena-spelet sen
        // this.container = $("#palettes");
    }
    htmlRender(){
        let outerShell = $("<div>").addClass("outerShell").attr("id", `pal_${this.id}`);
        let infoBox = $("<div>").addClass("infoBox");
        let palName = $("<div>").addClass("namnBox").html(this.name);
        let colorCircles = $("<div>").addClass("colorCircle");

        this.colors.forEach(color => {
            //vi måste kolla i vilken format vi får in färgerna.. sedan bara ändra css-background till respektive färg
            let nCircle = $("<div>").css("background", `rgb(${color[0]}, ${color[1]}, ${color[2]})`);
            colorCircles.append(nCircle);
        });

        outerShell.append(infoBox, colorCircles);
        infoBox.append(palName);
        return outerShell;
    }
}

//userns paletter till vänster
class PaletteSaved extends PaletteBase {
    constructor(data) {
        super(data);
        this.date = data.date;
    }
    htmlRender() {
        //lägger till elementet som visar datum
        //det andra skapas redan i palettebase
        //det som ska läggas till här: datum (span) och soptunna
        let basDiv = super.htmlRender();
        let datumDiv = $("<div>").html(`, ${getFormattedDateFromText(this.date)}`);
        let thisID = this.id;
        let trashCan = $("<img>").attr("src", "assetts/icons/trash.svg").addClass("delete").on("click", function(){
            // hitta elementet i gridden och ta bort hela outershell,
            console.log(thisID);
            // $("#ownPalettes").find(`.outerShell#pal_${thisID}`).css("display", "none");
            $("#ownPalettes").find(`.outerShell#pal_${thisID}`).remove();
            //hitta elementet i arrayn och splicea 
            
            //OMG IT FUCKING WEEERKS BIYAAATCH
            palettes = palettes.filter(palette => palette.id !== thisID);
            //delete till API
            let delID = {"id": thisID};
           
            let delReq = new Request ("api/apiReceiver.php",{
                method: "DELETE",
                body: JSON.stringify(delID),
                headers: {"Content-Type": "application/json; charset=UTF-8"}
            });
            console.log(delReq);
            fetch(delReq)
                .then(resp => resp.json())
                .then(deleted => {
                    console.log(deleted);
                });
            
            
        });
        basDiv.find(".namnBox").append(datumDiv);
        basDiv.find(".infoBox").append(trashCan);
        return basDiv;
    }
}

//allas paletter till höger
class PaletteOthers extends PaletteBase {
    constructor(data) {
        super(data);
        this.creator = data.creatorID;
    }
    htmlRender() {
        let basDiv = super.htmlRender();
        //lägger till elementet som visar användaren
        //det som ska läggas till här: creator (a-länk, där man sedan enbart hämtar in paletterna från samma creator)
        //i data finn endast id.. så man måste loopar igenom alla users och om userID == då hämta namnet från respektive element i arrayn
        let creatorEl = allUsers.find(user => user.id == this.creator);
        let thisCreator = this.creator;
        let creatorInfo = $("<a>").attr("href", "#").addClass(`B${this.creator}`).html(`(${creatorEl.name})`).on("click", function(e){
            $("#showAll p").html(`Palettes by ${creatorEl.name} <br> <a href="index.php">(Show palettes by all other users)</a>`);
            $("#allUsersPalettes").empty();
            palettes.forEach(palette => {
                if (palette.creatorID == thisCreator) {
                    let nPal = new PaletteOthers(palette);
                    $("#allUsersPalettes").append(nPal.htmlRender());
                }
            });
            
        });

        basDiv.find(".namnBox").append(creatorInfo);
        return basDiv;
    }
}

