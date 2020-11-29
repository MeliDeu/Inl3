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

