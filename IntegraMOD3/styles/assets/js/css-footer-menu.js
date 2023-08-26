function updatefootermenu() {
  if (document.getElementById('responsive-footer-menu').checked == true) {
    document.getElementById('menu_footer').style.borderBottomRightRadius = '0';
    document.getElementById('menu_footer').style.borderBottomLeftRadius = '0';
  }else{
    document.getElementById('menu_footer').style.borderRadius = '0px';
  } 
}
