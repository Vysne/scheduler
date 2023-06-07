function loadEditors() {
    var quill;
    let editors = document.querySelectorAll('.about-me-container div');

    if (editors) {
        editors.forEach(function (editor) {
           let editorInput = editor.nextElementSibling;

            quill = new Quill(editor, {
              modules: {
                  toolbar: false
              },
              theme: 'snow'
           });

           quill.pasteHTML(editorInput.value);
        });
    }
}

window.onload = loadEditors();
