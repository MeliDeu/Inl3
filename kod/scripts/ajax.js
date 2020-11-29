"use strict";
//script för att sköta all fetch med olika https-metoder

// form som api-respons kommer och endpoint
// url 'http://colormind.io/api/' --data-binary '{"model":"default"}'
					
// # {"result":[[214,78,69],[247,242,163],[201,216,147],[57,141,112],[62,80,64]]}


function sendLogin(){
  // e.preventDefault();
  let username = $("#username").val();
  let password = $("#password").val();
  let login = JSON.stringify({
    username: username,
    password: password
  });
  console.log(login);

  let loginRequest = new Request("admin/login.php",{
    method: "POST",
    body: login,
    headers: {"Content-Type": "application/json; charset=UTF-8"}
  });

  // fetch(loginRequest)
  // .then(
  //   resp => resp.json()
  // )
  // .then(resource => {
  //   console.log(resource);
  // })
}

$("#submit").on("click", function(){
  sendLogin()
});