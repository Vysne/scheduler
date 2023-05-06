// function loadFilterPlaceholders() {
//     let queryString = window.location.search;
//     let urlParams = new URLSearchParams(queryString);
//
//     let courseType = urlParams.get('filters[courses-type]');
//     courseTypeFilter(courseType);
//     let courseDate = urlParams.get('filters[courses-date]');
//     courseDateFilter(courseDate);
//     let courseRating = urlParams.get('filters[courses-rating]');
//     courseRatingFilter(courseRating);
//     let coursesEnlistment = urlParams.get('filters[courses-enlistment]');
//     courseEnlistmentFilter(coursesEnlistment);
// }

function resetFilters() {
    let resetButton = document.querySelector('button[type="reset"]');

    resetButton.addEventListener('click', function (evt) {
        window.location.href = 'http://127.0.0.1:8000/courses';
    });
}

// function courseTypeFilter($placeholder) {
//     let typeInput = document.getElementById('course-type').firstElementChild;
//     if ($placeholder !== '') {
//         typeInput.setAttribute('placeholder', $placeholder);
//         typeInput.value = $placeholder;
//     } else {
//         typeInput.setAttribute('placeholder', 'Select type');
//         typeInput.value = 'Select type';
//     }
// }
//
// function courseDateFilter($placeholder) {
//     let typeInput = document.getElementById('course-date').firstElementChild;
//     if ($placeholder !== '') {
//         typeInput.setAttribute('placeholder', $placeholder);
//         typeInput.value = $placeholder;
//     }
// }
//
// function courseRatingFilter($placeholder) {
//     let typeInput = document.getElementById('course-rating').firstElementChild;
//     if ($placeholder !== '') {
//         typeInput.setAttribute('placeholder', $placeholder);
//         typeInput.value = $placeholder;
//     }
// }
//
// function courseEnlistmentFilter($placeholder) {
//     let typeInput = document.getElementById('course-enlistment').firstElementChild;
//     if ($placeholder !== '') {
//         typeInput.setAttribute('placeholder', $placeholder);
//         typeInput.value = $placeholder;
//     }
// }

window.onload = resetFilters();

