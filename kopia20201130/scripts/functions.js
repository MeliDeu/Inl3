"use strict";

//script för deklarering av funktioner
//feedback for user in loginfields
function colorInputs(color){
  $("input").css("background-color", color);
}

function animation(element, aniName = false, t = 3){
  if (aniName == false){
    aniName = "messageAnimation";
  } else {
    aniName = "newPaletteAnimation";
  }
  $(element).css({
    animationName: "messageAnimation",
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


