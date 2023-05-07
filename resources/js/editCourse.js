// var editors = ['#course-descr', '#instructor-descr', '#syllabus-descr'];

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
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });

    quill.pasteHTML(courseEditorInput.value);

    quill.on('text-change', function () {
        getEditorHTML('#course-descr');
    });
}

function instructorEditorContainerNames() {
    var quill;

    let instructorEditorContainers = document.querySelectorAll('.about-instructor');

    instructorEditorContainers.forEach(function (container) {
       let editorDiv = container.firstElementChild;
       let editorInput = editorDiv.nextElementSibling;

       quill = new Quill(editorDiv, {
           modules: {
               toolbar: toolbarOptions
           },
           theme: 'snow'
       });

        quill.pasteHTML(editorInput.value);

        quill.on('text-change', function () {
            getEditorHTML(editorDiv);
        });
    });
}

function syllabusEdtiorContainers() {
    var quill;

    let syllabusEditorContainers = document.querySelectorAll('.syllabus-content');

    syllabusEditorContainers.forEach(function (container) {
       let editorDiv = container.querySelector('.text-upload-container').firstElementChild;
       let editorInput = editorDiv.nextElementSibling;

       quill = new Quill(editorDiv, {
           modules: {
               toolbar: toolbarOptions
           },
           theme: 'snow'
       });

       quill.pasteHTML(editorInput.value);

       quill.on('text-change', function () {
           getEditorHTML(editorDiv);
           updatePanelHeight(editorDiv);
       });
    });
}

function getEditorHTML(editors) {
    var editorHTML = [];
    for (var i = 0; i < editors.length; i++) {
        var html = document.querySelector(editors[i] + ' .ql-editor').innerHTML;
        let input = document.querySelector(`input[id="${editors[i].substring(1)}"]`);
        input.value = html;

        editorHTML.push(html);
    }
}

function updatePanelHeight(editors) {
    let containerElem = editors.parentElement.parentElement;
    let editorContainerElem = editors.parentElement;

    if (containerElem.getAttribute('class') === 'panel') {
        let editorContainerHeight = editorContainerElem.clientHeight;
        containerElem.setAttribute('style', 'max-height: ' + editorContainerHeight + 1000 + 'px');
    }
}

window.onload = [courseEditorContent(), instructorEditorContainerNames(), syllabusEdtiorContainers()];
