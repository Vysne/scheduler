function loadEditor() {
    var quill;

    let achievementInputs = document.querySelectorAll('.achievement-container input');
    achievementInputs.forEach(function (achievementInput) {
       let container = achievementInput.previousElementSibling;

       quill = new Quill(container, {
          modules: {
              toolbar: false,
          },
          readOnly: true,
          theme: 'snow'
       });

        quill.pasteHTML(achievementInput.value);
    });
}

window.onload = loadEditor();
