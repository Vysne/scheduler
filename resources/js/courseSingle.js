var editors = ['#course-descr'];

function loadCourseEditor() {
    var quill;

    let courseEditorInput = document.querySelector('input[id="course-descr"]');

    editors.forEach(function (editor) {
       quill = new Quill(editor, {
           modules: {
               toolbar: false,
           },
           readOnly: true,
           theme: 'snow'
       });

       quill.pasteHTML(courseEditorInput.value);
    });
}

function loadInstructorEditors() {
    var quill

    let instructorEditors = document.querySelectorAll('#instructor-descr');

    instructorEditors.forEach(function (instructorEditor) {
        quill = new Quill(instructorEditor, {
            modules: {
                toolbar: false,
            },
            readOnly: true,
            theme: 'snow'
        });

        let instructorEditorInput = instructorEditor.nextElementSibling;
        quill.pasteHTML(instructorEditorInput.value);
    });
}

function loadSyllabusEditors() {
    var quill

    let syllabusEditors = document.querySelectorAll('#syllabus-descr');

    syllabusEditors.forEach(function (syllabusEditor) {
        quill = new Quill(syllabusEditor, {
            modules: {
                toolbar: false,
            },
            readOnly: true,
            theme: 'snow'
        });

        let syllabusEditorInput = syllabusEditor.nextElementSibling;
        quill.pasteHTML(syllabusEditorInput.value);
    });
}

function hideSyllabus() {
    let syllabus = document.querySelector('.syllabus-content-disabled');

    if (syllabus !== null) {
        if (checkEnrollment() !== 'accepted') {
            console.log(syllabus);
            syllabus.classList.remove('syllabus-content-disabled');
            syllabus.classList.add('syllabus-content');
        } else {
            let syllabuses = document.querySelectorAll('.syllabus-content-disabled');

            syllabuses.forEach(function (syllabus) {
                syllabus.classList.remove('syllabus-content-disabled');
                syllabus.classList.add('syllabus-content');
            });
        }
    } else {
        let syllabuses = document.querySelectorAll('.syllabus-content-disabled');

        syllabuses.forEach(function (syllabus) {
            syllabus.classList.remove('syllabus-content-disabled');
            syllabus.classList.add('syllabus-content');
        });
    }
}

function checkEnrollment() {
    let input = document.getElementById('enroll-check');

    return input.value;
}

let ratDisplay = document.querySelector('.course-content-rating p');
let stars = document.querySelectorAll('.fa-star');
let totalStar = 0;

stars.forEach(function (star, index) {
    star.dataset.rating = index + 1;
    star.addEventListener('mouseover', onMouseOver);
    star.addEventListener('click', onClick);
    star.addEventListener('mouseleave', onMouseLeave);
});

function onMouseOver(e) {
    let ratingVal = e.target.dataset.rating;

    if (!ratingVal) {
        return;
    } else {
        fill(ratingVal);
    }
}

function onMouseLeave(e) {
    fill(totalStar);
}

function onClick(e) {
    let ratingVal = e.target.dataset.rating;
    let input = document.getElementById('user-rating');
    let form = document.getElementById('rating-form');
    totalStar = ratingVal;
    fill(totalStar);
    ratDisplay.innerHTML = ratingVal + '/5 stars';
    input.value = ratDisplay.innerHTML.charAt(0);
    form.submit();
}

function fill(ratingVal) {
    for (let i = 0; i < 5; i++) {
        if (i < ratingVal) {
            stars[i].classList.add('star-checked');
        } else {
            stars[i].classList.remove('star-checked');
        }
    }
}

function ratingLoad() {
    let ratingValue = document.getElementById('user-rating');
    let ratingText = document.querySelector('.course-content-rating p');

    if (ratingValue.value !== 0) {
        let starsNodeList = document.querySelectorAll('.fa-star');
        let starsArray = Array.from(starsNodeList);
        let selectedStars = starsArray.slice(0, ratingValue.value);

        selectedStars.forEach(function (star) {
            star.classList.add('star-checked');
        });
    }

    ratingText.innerHTML = ratingValue.value + '/5 stars';
}

window.onload = [loadCourseEditor(), loadInstructorEditors(), loadSyllabusEditors(), hideSyllabus(), ratingLoad()];
