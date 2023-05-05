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

    syllabus.classList.remove('syllabus-content-disabled');
    syllabus.classList.add('syllabus-content');
}

window.onload = [loadCourseEditor(), loadInstructorEditors(), loadSyllabusEditors(), hideSyllabus()];
