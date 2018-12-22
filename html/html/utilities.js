function clearChildren(element) {
   for (var i = 0; i < element.childNodes.length; i++) {
      var e = element.childNodes[i];
      if (e.tagName) switch (e.tagName.toLowerCase()) {
         case 'input':
            switch (e.type) {
               case "radio":
               case "checkbox": e.checked = false; break;
               case "button":
               case "submit":
               case "image": break;
               default: e.value = ''; break;
            }
            break;
         case 'select': e.selectedIndex = 0; break;
         case 'textarea': e.innerHTML = ''; break;
         default: clearChildren(e);
      }
   }
}

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
  return M + " "+yyyy;
}
