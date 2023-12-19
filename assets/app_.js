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

/*function selectCenturia(event) {
    if (event.target.classList.contains("selected-centuria")) {
        event.target.classList.remove("selected-centuria")
    }else if (event.target.classList.contains("list-group-item")) {
        event.target.classList.add("selected-centuria")
    }
}

window.addEventListener('click', selectCenturia);*/

var itemList = document.querySelectorAll("li.list-group-item.first-centuria")

function handleItemClick(event) {
    var clickedElement = event.target

    // Retirer la classe selected-centuria de tous les éléments de la liste
    itemList.forEach(function(item) {
        item.classList.remove("selected-centuria");
        const checkbox = item.querySelector('input[type="checkbox"]');
        checkbox.checked = false; // Inverse l'état de la case à cocher
    });

    // Ajouter la classe selected-centuria à l'élément cliqué
    clickedElement.classList.add("selected-centuria")
    const checkbox = clickedElement.querySelector('input[type="checkbox"]');
    checkbox.checked = !checkbox.checked; // Inverse l'état de la case à cocher
    
}

// Ajouter des écouteurs d'événements à chaque élément de la liste
itemList.forEach(function(item) {
    item.addEventListener('click', handleItemClick)
})

var itemList2 = document.querySelectorAll("li.list-group-item.second-centuria")

function handleItemClick2(event) {
    var clickedElement = event.target

    // Retirer la classe selected-centuria de tous les éléments de la liste
    itemList2.forEach(function(item) {
        item.classList.remove("selected-centuria");
        const checkbox = item.querySelector('input[type="checkbox"]');
        checkbox.checked = false; // Inverse l'état de la case à cocher
    });

    // Ajouter la classe selected-centuria à l'élément cliqué
    clickedElement.classList.add("selected-centuria")
    const checkbox = clickedElement.querySelector('input[type="checkbox"]');
    checkbox.checked = !checkbox.checked; // Inverse l'état de la case à cocher
    
}

// Ajouter des écouteurs d'événements à chaque élément de la liste
itemList2.forEach(function(item) {
    item.addEventListener('click', handleItemClick2)
})


const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})


