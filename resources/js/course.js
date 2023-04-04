function accordion() {
    let accordionElem = document.getElementsByClassName('accordion');
    let i;

    for (i = 0; i < accordionElem.length; i++) {
        accordionElem[i].addEventListener('click', function() {
            this.classList.toggle('active');
            let panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }
}

window.onload = accordion;
