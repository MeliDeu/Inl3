
function formatDate(date){
    // Accepts a Date-object.
    // Returns a date as a string with the format YY.MM.DD
    return date.getFullYear().toString().substr(-2) + "." + (date.getMonth() + 1) + "." + date.getDate() ;
}
//detta sparas i databasen
function getNowAsISO(){
    // Returns the current time and date as a string with ISO format
    // The return from this function can be saved in a DB as a string.
    return new Date().toISOString();
}
//html:a i själva diven, anropar första funktionen ovan så att man får rätt format 
function getFormattedDateFromText(text){
    // Accepts a date+time as a string (for instance in ISO format)
    // Returns the same date+time as received but in the format YY.MM.DD
    // This function can be used to transform the string from DB into a string with the format YY.MM.DD
    return formatDate(new Date(text));
}

let now = getNowAsISO();
// console.log("Current Date & Time (ISO format): " + now);
// console.log("Current Date & Time (YY.MM.DD): " + getFormattedDateFromText(now));