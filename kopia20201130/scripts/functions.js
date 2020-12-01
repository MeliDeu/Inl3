"use strict";

//script för deklarering av funktioner
//feedback for user in loginfields

//default är sortera byName
let sortSwitcher = false;

$("#byName").on("click", function(){
  $("#ownPalettes").empty();
  sortSwitcher = false;
  sortSwitch();
  palettes.forEach(palette => {
    if(loggedIn == palette.creatorID){
      let nPal = new PaletteSaved(palette);
      $("#ownPalettes").append(nPal.htmlRender());
    }
  });
});

$("#byDate").on("click", function(){
  $("#ownPalettes").empty();
  sortSwitcher = true;
  sortSwitch();
  palettes.forEach(palette => {
    if(loggedIn == palette.creatorID){
      let nPal = new PaletteSaved(palette);
      $("#ownPalettes").append(nPal.htmlRender());
    }
  });
});


function sortSwitch(){
  if(sortSwitcher == true){
    //sortera objekten i arrayen från senast tillagda (högst siffra)
    palettes.sort(function(a, b){
    return (a.date > b.date) ? -1 : ((a.date < b.date) ? 1 : 0);
    });
  } else if(sortSwitcher == false) {
    palettes.sort(function(a, b){
      return (a.name < b.name) ? -1 : ((a.name > b.name) ? 1 : 0);
    });
  }
}

function colorInputs(color){
  $("input").css("background-color", color);
}

function animation(element, aniName = false, t = 3){
  if (aniName == false){
    addAni = "messageAnimation";
  } else {
    addAni = "newPaletteAnimation";
  }
  $(element).css({
    animationName: addAni,
    animationDuration: `${t}s`,
    animationFillMode: "forwards",
    animationIterationCount: 1
  });
}


// byter inputfälten och ger meddelande. Behöver få animation fixad. Två anims.
if (data === 1){
  colorInputs("red");
  $("input").on("click", function(){
   colorInputs("white")
   
  });
  animation("#message", false, 4)
  $("#message").html("Both fields require entry");
} else if(data === 2){
    colorInputs("red")
    $("input").on("click", function(){
      colorInputs("white")  
    });
    $("#message").html("Wrong username or password");
  }
