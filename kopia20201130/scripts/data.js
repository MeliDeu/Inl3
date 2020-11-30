"use strict";

//här kan vi samla alla globala grejer, som tex vilken användare som är inloggad, alla paletter etc
let loggedInUser = false;
//måste hämta in allaUsers för att sedan kunna köra igenom dem när html-elementen skapas, då vi endast har user ID
let allUsers = [];
let palettes = [];

let testObj = {
  id: 1,
  name: "test",
  colors: [[214,78,69],[247,242,163],[201,216,147],[57,141,112],[62,80,64]]
}

if (data === 1){
  colorInputs("red");
  $("input").on("click", function(){
   colorInputs("white")
  });
  $("#message").html("Both fields must be filled.");
} else if(data === 2){
  colorInputs("red")
  $("input").on("click", function(){
    colorInputs("white")  
  });
  $("#message").html("Wrong username or password");
  animation("#message");
}