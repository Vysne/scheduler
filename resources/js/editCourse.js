var editors = ['#course-descr', '#instructor-descr', '#syllabus-descr'];

var toolbarOptions = [
    [{ 'font': [] }, { 'size': ['small', false, 'large', 'huge'] }],

    ['bold', 'italic', 'underline', 'strike'],
    [{ 'color': [] }, { 'background': [] }],

    [{ 'script': 'sub'}, { 'script': 'super' }],

    [{ 'header': 1 }, { 'header': 2 }, 'blockquote', 'code-block'],

    [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'indent': '-1'}, { 'indent': '+1' }],

    [{ 'direction': 'rtl' }, { 'align': [] }],

    [ 'link', 'image', 'video'],

    ['clean']
];

function courseEditorContent() {
    var quill;

    let courseEditor = document.getElementById('course-descr');
    let courseEditorInput = document.querySelector('input[id="course-descr"]');

    quill = new Quill(courseEditor, {
        toolbar: toolbarOptions,
        theme: 'snow'
    });

    quill.pasteHTML(courseEditorInput.value);
}

function instructorEditorContainerNames() {
    var quill;

    let instructorEditorContainers = document.querySelectorAll('.about-instructor');

    instructorEditorContainers.forEach(function (container) {
       let editorDiv = container.firstElementChild;
       let editorInput = editorDiv.nextElementSibling;

       quill = new Quill(editorDiv, {
          toolbar: toolbarOptions,
          theme: 'snow'
       });

        quill.pasteHTML(editorInput.value);
    });
}

window.onload = [courseEditorContent(), instructorEditorContainerNames()];
