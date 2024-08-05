function updatemenu() {
  var menuItems = document.getElementsByClassName('menu');
  if (document.getElementsByClassName('responsive-menu')[0].checked == true) {
    menuItems[0].style.borderBottomRightRadius = '0';
    menuItems[0].style.borderBottomLeftRadius = '0';
  } else {
    menuItems[0].style.borderRadius = '0px';
  }
}


