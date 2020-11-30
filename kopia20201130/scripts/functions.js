"use strict";
//script för deklarering av funktioner
function colorInputs(color){
  $("input").css("background-color", color);
}

function animation(element){
  $(element).addClass("animation");
}