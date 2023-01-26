// menu burger
var burgerMenu = document.getElementById('menu_burger')
var menu = document.getElementById('menu_list')
var links = document.getElementsByClassName('link')
var menuBg = document.getElementById("burger_top")
var menuBgb = document.getElementById("burger_bottom")

console.log(links)
burgerMenu.addEventListener('click', function () {
    this.classList.toggle("close");
    menu.classList.toggle("open");
    menuBg.classList.toggle("hideen")
    menuBgb.classList.toggle("hideen")

})

for (let i = 0; i < links.length; i++) {
    links[i].addEventListener('click', function () {
        console.log('clicker')
        menu.classList.toggle('open');
    })

}
