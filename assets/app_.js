/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

import 'bootstrap'

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app_.scss';

// start the Stimulus application
import './bootstrap';

//Import web icons library
import 'boxicons';

import 'bootstrap';
//import bsCustomFileInput from 'bs-custom-file-input';

//bsCustomFileInput.init();

/*=============== SCROLL SECTIONS ACTIVE LINK ===============*/
const sections = document.querySelectorAll('section[id]')

function scrollActive(){
    const scrollY = window.pageYOffset

    sections.forEach(current =>{
        const sectionHeight = current.offsetHeight,
            sectionTop = current.offsetTop - 50,
            sectionId = current.getAttribute('id')

        if(scrollY > sectionTop && scrollY <= sectionTop + sectionHeight){
            document.querySelector('.nav__menu a[href*=' + sectionId + ']').classList.add('active-link')
        }else{
            document.querySelector('.nav__menu a[href*=' + sectionId + ']').classList.remove('active-link')
        }
    })
}
window.addEventListener('scroll', scrollActive)


/*=============== CHANGE BACKGROUND HEADER ===============*/
function scrollHeader(){
    const header = document.getElementById('header')
    // When the scroll is greater than 80 viewport height, add the scroll-header class to the header tag
    if(this.scrollY >= 80) header.classList.add('scroll-header'); else header.classList.remove('scroll-header')
}
window.addEventListener('scroll', scrollHeader)

function selectCenturia(){
    var navItems = document.querySelectorAll(".list-group-item");
    for (var i = 0; i < navItems.length; i++) {
        navItems[i].addEventListener("click", function() {
        //var selectedNavItems = navItems.classList.getElementsByClassName("selected-centuria")
        //selectedNavItems[i].classList.remove("selected-centuria")
        this.classList.add("selected-centuria")
    });
    } 
}

window.addEventListener('click', selectCenturia)


const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})