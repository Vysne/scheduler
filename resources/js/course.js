// function accordion() {
//     let accordionElem = document.getElementsByClassName('accordion');
//     let i;
//
//     for (i = 0; i < accordionElem.length; i++) {
//         let contentDiv = accordionElem[i].parentElement;
//         accordionElem[i].addEventListener('click', function() {
//             if (contentDiv.className !== 'syllabus-content-disabled') {
//                 this.classList.toggle('active');
//                 let panel = this.nextElementSibling;
//                 if (panel.style.maxHeight) {
//                     panel.style.maxHeight = null;
//                 } else {
//                     panel.style.maxHeight = panel.scrollHeight + "px";
//                 }
//             }
//         });
//     }
// }
//
// window.onload = accordion();
