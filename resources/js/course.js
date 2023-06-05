function markComplete() {
    let buttons = document.querySelectorAll('.mark-not-complete');

    buttons.forEach(function (button) {
        let accordionBtn = button.parentElement.previousElementSibling;
        accordionBtn.classList.add('syllabus-complete');
    });
}

window.onload = markComplete();
