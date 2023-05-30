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

function ratingLoad() {
    let ratingValues = document.querySelectorAll('.course-rating input');
    ratingValues.forEach(function (ratingValue) {
        if (ratingValue.value !== 0) {
            let starContainer = ratingValue.parentElement;
            let starsNodeList = starContainer.querySelectorAll('.fa-star');
            let starsArray = Array.from(starsNodeList);
            let selectedStars = starsArray.slice(0, ratingValue.value);

            selectedStars.forEach(function (star) {
                star.classList.add('star-checked');
            });
        }
    });
}

function loadLimit() {
    let limitElem = document.getElementById('course-limit');

    if (limitElem.value === '0') {
        limitElem.setAttribute('placeholder', 'No limit');
        limitElem.removeAttribute('value');
    }
}

function changeLimit() {
    let limitElem = document.getElementById('course-limit');

    limitElem.addEventListener('change', function() {
        var limitValue = parseInt(limitElem.value);

        if (limitValue === 0) {
            limitElem.value = '';
            limitElem.placeholder = 'No limit';
        }
    });
}

window.onload = [myCoursesTable(), createdCoursesTable(), ratingLoad(), loadLimit(), changeLimit()]
