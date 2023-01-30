// menu burger
var burgerMenu = document.getElementById('menu_burger')
var menu = document.getElementById('menu_list')
var links = document.getElementsByClassName('link')
var menuBg = document.getElementById("burger_top")
var menuBgb = document.getElementById("burger_bottom")

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

// dark mode
let sun = document.querySelector('.fa-sun');
let moon = document.querySelector('.fa-moon')
let mode = document.getElementById('mode')
let body = document.querySelector('body')

mode.addEventListener('click', function () {

    if (body.classList.contains('light')) {
        this.classList.remove('dark')
        body.classList.remove('light');
        sun.classList.remove('close')
        moon.classList.remove('open')
        localStorage.setItem("theme", "dark");

    } else {
        this.classList.add('dark')
        body.classList.add('light');
        sun.classList.add('close')
        moon.classList.add('open')
        localStorage.setItem("theme", "light");

    }
})
// si le theme est light
if (localStorage.getItem("theme") === "light") {
    body.classList.add('light')
    mode.classList.add('dark')
    sun.classList.add('close')
    moon.classList.add('open')
    console.log('light')
}



