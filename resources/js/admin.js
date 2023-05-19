function courseCreatorTable() {
    let button = document.getElementById('creator-button');

    button.addEventListener('click', function (evt) {
        let courseRequestTable = document.getElementById('course-table');
        let courseButton = document.getElementById('course-button');
        let courseCreatorRequestTable = document.getElementById('course-creator-table');

        courseRequestTable.setAttribute('hidden', '');
        courseCreatorRequestTable.removeAttribute('hidden');
        button.classList.add('active');
        courseButton.classList.remove('active');
    });
}

function courseReguestTable() {
    let button = document.getElementById('course-button');

    button.addEventListener('click', function (evt) {
        let courseCreatorRequestTable = document.getElementById('course-creator-table');
        let courseCreatorButton = document.getElementById('creator-button');
        let courseRequestTable = document.getElementById('course-table');

        courseRequestTable.removeAttribute('hidden');
        courseCreatorRequestTable.setAttribute('hidden', '');
        button.classList.add('active');
        courseCreatorButton.classList.remove('active');
    });
}

window.onload = [courseCreatorTable(), courseReguestTable()];
