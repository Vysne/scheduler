function myCoursesTable() {
    let button = document.getElementById('members-button');

    button.addEventListener('click', function (evt) {
        let myCoursesTable = document.getElementById('my-courses-table');
        let createdCoursesButton = document.getElementById('enlistment-button');
        let createdCoursesTable = document.getElementById('created-courses-table');

        createdCoursesTable.setAttribute('hidden', '');
        myCoursesTable.removeAttribute('hidden');
        button.classList.add('active');
        createdCoursesButton.classList.remove('active');
    });
}

function createdCoursesTable() {
    let button = document.getElementById('enlistment-button');

    button.addEventListener('click', function (evt) {
        let createdCoursesTable = document.getElementById('created-courses-table');
        let myCoursesTable = document.getElementById('my-courses-table');
        let myCoursesButton = document.getElementById('members-button');

        createdCoursesTable.removeAttribute('hidden');
        myCoursesTable.setAttribute('hidden', '');
        button.classList.add('active');
        myCoursesButton.classList.remove('active');
    });
}

window.onload = [myCoursesTable(), createdCoursesTable()]
