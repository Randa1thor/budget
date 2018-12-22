

function dateMYYYY(){
  var today = new Date();
  var mm = today.getMonth()+1; //January is 0!
  var yyyy = today.getFullYear();
  var M="";
  switch(mm){
    case 1: M="Jan";break;
    case 2: M="Feb";break;
    case 3: M="Mar";break;
    case 4: M="Apr";break;
    case 5: M="May";break;
    case 6: M="June";break;
    case 7: M="July";break;
    case 8: M="Aug";break;
    case 9: M="Sept";break;
    case 10: M="Oct";break;
    case 11: M="Nov";break;
    case 12: M="Dec";break;
    default: M="Jan";break;
  }
  return M + " " +yyyy;
}
