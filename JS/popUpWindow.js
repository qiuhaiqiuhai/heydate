function popUpWindow(url) {
 html = "<HTML><HEAD><TITLE>Photo</TITLE>" +
  "</HEAD><BODY LEFTMARGIN=0 " 
  + "MARGINWIDTH=0 TOPMARGIN=0 MARGINHEIGHT=0><CENTER>" 
  + "<IMG SRC='" + url + "' BORDER=0 NAME=image " 
  + "onload='window.resizeTo(document.image.width,document.image.height)'>"
  + "</CENTER>" 
  + "</BODY></HTML>";
 popup=
 window.open
  ('','image',
  'toolbar=0,location=0,directories=0,menuBar=0,scrollbars=0,resizable=1');
 popup.document.open();
 popup.document.write(html);
 popup.document.focus();
 popup.document.close()
 };