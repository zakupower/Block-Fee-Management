var counter = 1;
var limit = 4;
var tabindex = 8;
function addInput(divName){
     if (counter == limit)  {
          alert("Максималният брой входове е 4.");
     }
     else { 
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "<div class=\"row\">\r\n\t\t\t\t\r\n\t\t\t\t\t<div class=\"col-xs-9 col-sm-9 col-md-9\">\r\n\t\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t\t<input type=\"text\" name=\"adresi[]\" id=\"adresi[]\" class=\"form-control input-lg\" placeholder=\"\u0410\u0434\u0440\u0435\u0441\" tabindex=\""+(++tabindex)+"\">\r\n\t\t\t\t\t\t<\/div>\r\n\t\t\t\t\t<\/div>\r\n\t\t\t\t\t<div class=\"col-xs-3 col-sm-3 col-md-3\">\r\n\t\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t\t<input type=\"text\" name=\"vhodove[]\" id=\"vhodove[]\" class=\"form-control input-lg\" placeholder=\"\u0412\u0445\u043E\u0434\" tabindex=\""+(++tabindex)+"\">\r\n\t\t\t\t\t\t<\/div>\r\n\t\t\t\t\t<\/div>\r\n\t\t\t\t\t\r\n\t\t\t\t<\/div>";
          document.getElementById(divName).appendChild(newdiv);
          counter++;
     }
}