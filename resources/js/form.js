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

function loadEditor() {
    // Quill.register('modules/counter', function(quill, options) {
    //     var container = document.querySelector(options.container);
    //     quill.on('text-change', function() {
    //         var text = quill.getText();
    //         if (options.unit === 'word') {
    //             container.innerText = text.split(/\s+/).length + ' words';
    //         } else {
    //             container.innerText = text.length + ' characters';
    //         }
    //     });
    // });
    var quill;
    // var modules;
    //
    // if (editors.length > 3) {
    //     modules = {
    //         toolbar: false,
    //     }
    // } else {
    //     modules = {
    //         toolbar: toolbarOptions,
    //     }
    // }
    editors.forEach(function (editor) {
        quill = new Quill(editor, {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });
        // quill = new Quill(editor, {
        //     modules: {
        //         toolbar: toolbarOptions,
        //         // counter: {
        //         //     container: ['#counter', '#counter-2'],
        //         //     unit: 'character'
        //         // }
        //     },
        //     theme: 'snow'
        // });
        quill.on('text-change', function () {
            getEditorHTML(editors);
            updatePanelHeight(editors);
        });
    });

    // var form = document.querySelector('.course-single-container form');
    //
    // form.onsubmit = function() {
    //     // Populate hidden form on submit
    //     var about = document.querySelector('input[name=course-descr-body]');
    //     console.log(about);
    //     about.value = JSON.stringify(quill.getContents());
    //     console.log(about.value);
    //
    //     return true;
    // }
}

function uniqueId(editor, section) {
    AmagiLoader.show();
    let sectionEditors;

    if (section.getAttribute('class') === 'instructor-content') {
        sectionEditors = section.querySelectorAll('.about-instructor');

        let value = sectionEditors.length;

        setTimeout(function () {
            editor.setAttribute('id', 'instructor-descr' + value);
            let editorInput = editor.nextElementSibling;
            let elementInput = editor.nextElementSibling.nextElementSibling;

            editorInput.setAttribute('id', 'instructor-descr' + value);
            editorInput.setAttribute('name', 'instructor[condition' + value + ']' + '[instructor-descr-body]');
            elementInput.setAttribute('name', 'instructor[condition' + value + ']' + '[element-name]');
            elementInput.value = editor.getAttribute('id');

            editors.push('#' + editor.getAttribute('id'));

            loadEditor();
            destroyEditorToolbars();
            AmagiLoader.hide();
        }, 3000 );
    } else {
        sectionEditors = section.querySelectorAll('.panel');

        let value = sectionEditors.length;

        setTimeout(function () {
            editor.setAttribute('id', 'syllabus-descr' + value);
            let editorInput = editor.nextElementSibling;
            let elementInput = editor.nextElementSibling.nextElementSibling;

            editorInput.setAttribute('id', 'syllabus-descr' + value);
            editorInput.setAttribute('name', 'syllabus[condition' + value + ']' + '[syllabus-descr-body]');
            elementInput.setAttribute('name', 'syllabus[condition' + value + ']' + '[element-name]');
            elementInput.value = editor.getAttribute('id');

            editors.push('#' + editor.getAttribute('id'));

            loadEditor();
            destroyEditorToolbars();
            AmagiLoader.hide();
        }, 3000 );
    }
}

function destroyEditorToolbars() {
    let descriptionEditorToolbar = document.querySelector('.course-description .ql-toolbar:first-child');
    descriptionEditorToolbar.remove();

    let instructorEditorToolbars = document.querySelectorAll('.about-instructor .ql-toolbar:first-child');
    instructorEditorToolbars.forEach(function (editor) {
       editor.remove();
    });

    let syllabusEditorToolbars = document.querySelectorAll('.panel .ql-toolbar:first-child');
    syllabusEditorToolbars.forEach(function (editor) {
       editor.remove();
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
    for (var i = 0; i < editors.length; i++) {

        let editorElem = document.querySelector(editors[i]);
        let containerElem = editorElem.parentElement.parentElement;
        let editorContainerElem = editorElem.parentElement;

        if (containerElem.getAttribute('class') === 'panel') {
            let editorContainerHeight = editorContainerElem.clientHeight;
            containerElem.setAttribute('style', 'max-height: ' + editorContainerHeight + 1000 + 'px');
        }
    }
}

// function updateLink() {
//     lastLinkRange = null;
//     var selection = quill.getSelection(),
//         selectionChanged = false;
//     if (selection === null) {
//         var tooltip = quill.theme.tooltip;
//         if (tooltip.hasOwnProperty('linkRange')) {
//             // user started to edit a link
//             lastLinkRange = tooltip.linkRange;
//             return;
//         } else {
//             // user finished editing a link
//             var format = quill.getFormat(lastLinkRange),
//                 link = format.link;
//             quill.setSelection(lastLinkRange.index, lastLinkRange.length, 'silent');
//             selectionChanged = true;
//         }
//     } else {
//         var format = quill.getFormat();
//         if (!format.hasOwnProperty('link')) {
//             return; // not a link after all
//         }
//         var link = format.link;
//     }
//     // add protocol if not there yet
//     if (!/^https?:/.test(link)) {
//         link = 'http:' + link;
//         quill.format('link', link);
//         // reset selection if we changed it
//         if (selectionChanged) {
//             if (selection === null) {
//                 quill.setSelection(selection, 0, 'silent');
//             } else {
//                 quill.setSelection(selection.index, selection.length, 'silent');
//             }
//         }
//     }
// }

function addTime() {
    let button = document.getElementById('add-time');
    let condition = button.parentElement.parentElement;
    let marker = document.getElementById('marker');

    button.addEventListener('click', function () {
        let sectionInputs = document.querySelectorAll('#time-input-container');
        let validation = validator(condition);
        let max = maxConditions();
        if (validation !== 'false' && max !== true) {
            let elem = document.querySelector('#time-input-container');
            let clone = elem.cloneNode(true);

            let daySelect = clone.firstElementChild;
            let dayInput = daySelect.querySelector('input');
            dayInput.setAttribute('name', 'date[condition' + sectionInputs.length + ']' + '[day]');

            let timeSelect = clone.lastElementChild;
            let timeInput = timeSelect.querySelector('input');
            timeInput.setAttribute('name', 'date[condition' + sectionInputs.length + ']' + '[time]');

            let removeDiv = document.createElement('div');
            removeDiv.setAttribute('class', 'remove-condition');
            let removeButton = document.createElement('button');
            removeButton.setAttribute('id', 'remove-time');
            removeButton.innerHTML = '<i class="fa fa-times" aria-hidden="true"></i>';

            clone.append(removeDiv);
            removeDiv.append(removeButton);
            condition.insertBefore(clone, marker);

            clearValues(clone);
            removeTime(clone);
        } else {
            return 'Not all fields are filled!';
        }
    });
}

function removeTime(condition) {
    let button = condition.querySelector('#remove-time');

    button.addEventListener('click', function () {
        condition.remove();

        let conditions = document.querySelectorAll('#time-input-container:not(:first-child)');
        var i = 1;

        conditions.forEach(function (condition) {
            let dayInput = condition.querySelector('.day-select input');
            let timeInput = condition.querySelector('.time-input input');
            let counter = i++;

            dayInput.setAttribute('name', 'date[daytime-condition' + counter + ']' + '[day]');
            timeInput.setAttribute('name', 'date[daytime-condition' + counter + ']' + '[time]');
        });
    });
}

function validator(condition) {
    let enteredValues = '';
    let inputs = condition.querySelectorAll('input');

    inputs.forEach(function (input) {
        if (input.value) {
            enteredValues = 'true';
        } else {
            enteredValues = 'false';
        }
    });

    return enteredValues;
}

// function quilValidator(condition) {
//     let filledValues = '';
//     let textDiv = condition.querySelector('.text-editor');
//     let counter = textDiv.lastElementChild;
//     let img = condition.querySelector('#display-image');
//
//     if (counter.innerHTML !== '0 characters' && img.getAttribute('style')) {
//         filledValues = 'true';
//     } else {
//         filledValues = 'false';
//     }
//
//     return filledValues;
// }

function maxConditions() {
    let conditions = document.querySelectorAll('#time-input-container');

    if (conditions.length === 7) {
        return true;
    }
}

function clearValues(condition) {
    let inputs = condition.querySelectorAll('input');

    inputs.forEach(function (input) {
        input.value = '';
    });
}

function addSkill() {
    let button = document.getElementById('add-skill');

    button.addEventListener('click', function () {
        let skillInptus = document.querySelectorAll('.skills-card');
        let container = document.querySelector('.skills-content');
        let input = document.querySelector('.skills-card');
        let inputClone = input.cloneNode(false);

        let removeDiv = document.createElement('div');
        let inputField = document.createElement('input');
        removeDiv.setAttribute('class', 'remove-condition');
        removeDiv.innerHTML = '<i class="fa fa-times" aria-hidden="true"></i>';
        inputField.setAttribute('type', 'text');
        inputField.setAttribute('name', 'skill[condition' + skillInptus.length + ']' + '[skill]');
        inputField.setAttribute('required', '');

        container.append(inputClone);
        inputClone.append(removeDiv);
        inputClone.append(inputField)

        removeSkill(inputClone);
    });
}

function addInstructor() {
    let button = document.getElementById('add-instructor');

    button.addEventListener('click', function () {
       let instructorImageInputs = document.querySelectorAll('.instructor-image');
       let content = document.querySelector('.instructor-content');
       let container = document.querySelector('.instructor-card');

       // if (quilValidator(container) !== 'false') {
           let containerClone = container.cloneNode(true);
           let containerCloneEditor = containerClone.querySelector('.ql-container');
           let instructorImg = containerClone.querySelector('.upload-container input');
           instructorImg.setAttribute('name', 'instructor[condition' + instructorImageInputs.length + ']' + '[img]');
           uniqueId(containerCloneEditor, content);

           let removeDiv = document.createElement('div');
           removeDiv.setAttribute('class', 'remove-condition');
           removeDiv.innerHTML = '<i class="fa fa-times" aria-hidden="true"></i>';

           containerClone.append(removeDiv);
           content.append(containerClone);

           let cloneImgDiv = containerClone.querySelector('#display-image');
           cloneImgDiv.style.backgroundImage = 'unset';

           clearValues(containerClone);
           removeInstructor(containerClone);
       // } else {
       //     return 'Not all fields are filled!';
       // }
    });
}

function addSection() {
    let button = document.getElementById('add-section');

    button.addEventListener('click', function () {
       let syllabusInputs = document.querySelectorAll('.syllabus-content');
       let container = document.querySelector('.syllabuses');
       let content = document.querySelector('.syllabus-content');

       let containerClone = content.cloneNode(true);
       let containerCloneEditor = containerClone.querySelector('.ql-container');
       let syllabusNameInput = containerClone.querySelector('input');
       syllabusNameInput.setAttribute('name', 'syllabus[condition' + syllabusInputs.length + ']' + '[syllabus-name]');
       uniqueId(containerCloneEditor, container);

       let controlsDiv = containerClone.firstElementChild;
       let removeDiv = document.createElement('div');
        removeDiv.setAttribute('class', 'remove-condition');
        removeDiv.innerHTML = '<i class="fa fa-times" aria-hidden="true"></i>';

        controlsDiv.append(removeDiv);
        container.append(containerClone);

        syllabusTypeVideo();
        syllabusTypeText();
        removeSection(containerClone);
    });
}

function syllabusTypeVideo() {
    let buttons = document.querySelectorAll('.syllabus-type-button[data-type="video"]');

    buttons.forEach(function (button) {
       button.addEventListener('click', function () {
           let textPanel = button.parentElement.nextElementSibling.nextElementSibling;
           textPanel.setAttribute('hidden', '');

           let panel = button.parentElement.parentElement;
           let uploadContainer = panel.querySelector('.video-upload-container');

           uploadContainer.removeAttribute('hidden');
           panel.setAttribute('style', 'max-height: 409px;')

           let fileInput = panel.querySelector('#video-file-input');
           let fileList = panel.querySelector('#files-list');
           let numOfFiles = panel.querySelector('#num-of-files');

           fileInput.addEventListener('change', function () {
               fileList.innerHTML = '';
               numOfFiles.textContent = `${fileInput.files.length}
               Files Selected`;

               for (let i of fileInput.files) {
                   let reader = new FileReader();
                   let listItem = document.createElement('li');
                   let fileName = i.name;
                   let fileSize = (i.size / 1024).toFixed(1);
                   listItem.innerHTML = `<p>${fileName}</p><p>${fileSize}KB</p>`;
                   if (fileSize >= 1024) {
                       fileSize = (fileSize / 1024).toFixed(1);
                       listItem.innerHTML = `<p>${fileName}</p><p>${fileSize}MB</p>`
                   }
                   fileList.appendChild(listItem);
                   panel.removeAttribute('style');
                   panel.setAttribute('style', 'height=100%');
               }
           });
       });
    });
}

function syllabusTypeText() {
    let buttons = document.querySelectorAll('.syllabus-type-button[data-type="text"]');

    buttons.forEach(function (button) {
        button.addEventListener('click', function () {
            let videoPanel = button.parentElement.nextElementSibling;
            videoPanel.setAttribute('hidden', '');

            let panel = button.parentElement.parentElement;
            let uploadContainer = panel.querySelector('.text-upload-container');

            uploadContainer.removeAttribute('hidden');
            panel.setAttribute('style', 'max-height: 409px;')
        });
    });
}

function removeSkill(clone) {
    let button = clone.querySelector('i');

    button.addEventListener('click', function () {
        clone.remove();

        let conditions = document.querySelectorAll('.skills-card:not(:first-child)');
        var i = 1;

        conditions.forEach(function (condition) {
            let skillInput = condition.querySelector('input');
            let counter = i++;

            skillInput.setAttribute('name', 'skill[skill-condition' + counter + ']');
        });
    });
}

function removeInstructor(clone) {
    let button = clone.querySelector('.remove-condition i');

    button.addEventListener('click', function () {
        clone.remove();

        let conditions = document.querySelectorAll('.instructor-card:not(:first-child)');
        var i = 1;

        conditions.forEach(function (condition) {
            let counter = i++;
            let instructorImg = condition.querySelector('.upload-container input');
            let instructorEditor = condition.querySelector('.ql-container');
            let editorInput = instructorEditor.nextElementSibling;
            let elementInput = editorInput.nextElementSibling;

            instructorImg.setAttribute('name', 'instructor[instructor-condition' + counter + ']' + '[img]');
            instructorEditor.setAttribute('id', 'instructor-descr' + counter);
            editorInput.setAttribute('id', 'instructor-descr' + counter);
            editorInput.setAttribute('name', 'instructor[instructor-condition' + counter + ']' + '[instructor-descr-body]');
            elementInput.setAttribute('name', 'instructor[instructor-condition' + counter + ']' + '[element-name]');
            elementInput.value = instructorEditor.getAttribute('id');
        });
        removeEditorInstance();
    });
}

function removeSection(clone) {
    let button = clone.querySelector('.remove-condition i');

    button.addEventListener('click', function () {
        clone.remove();

        let conditions = document.querySelectorAll('.syllabus-content:not(:first-child)');
        var i = 1;

        conditions.forEach(function (condition) {
            let counter = i++;
            let titleInput = condition.querySelector('input');
            let instructorEditor = condition.querySelector('.ql-container');
            let editorInput = instructorEditor.nextElementSibling;
            let elementInput = editorInput.nextElementSibling;

            titleInput.setAttribute('name', 'syllabus[syllabus-condition' + counter + '][syllabus-name]');
            instructorEditor.setAttribute('id', 'syllabus-descr' + counter);
            editorInput.setAttribute('id', 'syllabus-descr' + counter);
            editorInput.setAttribute('name', 'syllabus[syllabus-condition' + counter + ']' + '[syllabus-descr-body]');
            elementInput.setAttribute('name', 'syllabus[syllabus-condition' + counter + ']' + '[element-name]');
            elementInput.setAttribute('value', 'syllabus-descr' + counter);
        });
        removeEditorInstance();
    });
}

function removeEditorInstance() {
    let editorArray = [];
    let instructorEditors = document.querySelectorAll('.ql-container');

    instructorEditors.forEach(function (instructorEditor) {
        let editorId = '#' + instructorEditor.getAttribute('id');
        editorArray.push(editorId);
    });
    editors.forEach(function (editorId) {
        let existFactor = editorArray.includes(editorId);

        if (existFactor !== true) {
            let index = editors.indexOf(editorId);

            editors.splice(index, 1);
        }
    });
}

window.onload = [loadEditor(), addTime(), addSkill(), addInstructor(), addSection(), syllabusTypeVideo(), syllabusTypeText()];

