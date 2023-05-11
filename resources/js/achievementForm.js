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

function loadEditor() {
    var quill;

    let achievementInputs = document.querySelectorAll('.achievement-container input');
    achievementInputs.forEach(function (achievementInput) {
       let container = achievementInput.previousElementSibling;

       quill = new Quill(container, {
          modules: {
              toolbar: toolbarOptions
          },
          theme: 'snow'
       });

       quill.on('text-change', function () {
          getEditorHTML(container);
       });
    });
}

function getEditorHTML(container) {
    var editorHTML = [];
    var html = container.firstElementChild.innerHTML;
    let input = container.nextElementSibling;
    input.value = html;

    editorHTML.push(html);
}

window.onload = loadEditor();
