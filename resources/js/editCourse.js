var editors = ['#syllabus-descr'];

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
           updateFirstPanelHeight(editorDiv);
       });
    });
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

function loadEditor() {
    var quill;

    editors.forEach(function (editor) {
        quill = new Quill(editor, {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });

        quill.on('text-change', function () {
            getEditorHTML(editors);
            updatePanelHeight(editors);
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

function updatePanelHeight() {
    editors.forEach(function(editor) {
        let editorElem = document.querySelector(editor);
        let containerElem = editorElem.parentElement.parentElement;

        if (containerElem.getAttribute('class') === 'panel') {
            let editorContainerHeight = editorElem.clientHeight;
            containerElem.setAttribute('style', 'max-height: ' + editorContainerHeight + 1000 + 'px');
        }
    });
}

function updateFirstPanelHeight(editor) {
    let containerElem = editor.parentElement.parentElement;
    let editorContainerHeight = editor.clientHeight;

    containerElem.setAttribute('style', 'max-height:' + editorContainerHeight + 1000 + 'px');
}

function timeRemoveButton()
{
    let timeContainers = document.querySelectorAll('#time-input-container:not(:first-child)');

    timeContainers.forEach(function (timeContainer) {
        let removeDiv = document.createElement('div');
        removeDiv.setAttribute('class', 'remove-condition');
        let removeButton = document.createElement('button');
        removeButton.setAttribute('id', 'remove-time');
        removeButton.innerHTML = '<i class="fa fa-times" aria-hidden="true"></i>';
        removeButton.setAttribute('onclick', 'removeTime(this)');

        timeContainer.append(removeDiv);
        removeDiv.append(removeButton);
    });
}

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
            removeButton.setAttribute('onclick', 'removeTime(this)');

            clone.append(removeDiv);
            removeDiv.append(removeButton);
            condition.insertBefore(clone, marker);

            clearValues(clone);
        } else {
            return 'Not all fields are filled!';
        }
    });
}

function skillRemoveButton()
{
    let skillContainers = document.querySelectorAll('.skills-card:not(:first-child)');

    skillContainers.forEach(function (skillContainer) {
        let removeDiv = document.createElement('div');
        let inputField = skillContainer.firstElementChild;

        removeDiv.setAttribute('class', 'remove-condition');
        removeDiv.innerHTML = '<i class="fa fa-times" aria-hidden="true"></i>';
        removeDiv.setAttribute('id', 'remove-time');
        removeDiv.innerHTML = '<i class="fa fa-times" aria-hidden="true"></i>';
        removeDiv.setAttribute('onclick', 'removeSkill(this)');

        skillContainer.insertBefore(removeDiv, inputField);
    });
}

function addSkill() {
    let button = document.getElementById('add-skill');

    button.addEventListener('click', function () {
        let skillInptus = document.querySelectorAll('.skills-card');
        let skillsContainer = document.querySelector('.skills-content');
        let inputClone = document.querySelector('.skills-card').cloneNode(false);

        let removeDiv = document.createElement('div');
        let inputField = document.createElement('input');

        removeDiv.setAttribute('class', 'remove-condition');
        removeDiv.innerHTML = '<i class="fa fa-times" aria-hidden="true"></i>';
        removeDiv.setAttribute('onclick', 'removeSkill(this)');
        inputField.setAttribute('type', 'text');
        inputField.setAttribute('name', 'skill[condition' + skillInptus.length + ']' + '[skill]');
        inputField.setAttribute('required', '');

        skillsContainer.append(inputClone);
        inputClone.append(removeDiv);
        inputClone.append(inputField);
    });
}

function instructorRemoveButton() {
    let instructorContainers = document.querySelectorAll('.instructor-card:not(:first-child)');

    instructorContainers.forEach(function (instructorContainer) {
        let removeDiv = document.createElement('div');
        removeDiv.setAttribute('class', 'remove-condition');
        removeDiv.innerHTML = '<i class="fa fa-times" aria-hidden="true"></i>';
        // removeDiv.setAttribute('onclick', 'removeInstructor(this)');

        instructorContainer.append(removeDiv);
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
        let aboutContainer = containerClone.querySelector('.about-instructor');
        let containerCloneEditor = containerClone.querySelector('.ql-container');
        let instructorImg = containerClone.querySelector('.upload-container input');
        instructorImg.setAttribute('name', 'instructor[condition' + instructorImageInputs.length + ']' + '[img]');
        aboutContainer.setAttribute('class', 'about-instructor instructor-new');
        uniqueId(containerCloneEditor, content);

        let removeDiv = document.createElement('div');
        removeDiv.setAttribute('class', 'remove-condition');
        removeDiv.innerHTML = '<i class="fa fa-times" aria-hidden="true"></i>';
        // removeDiv.setAttribute('onclick', 'removeInstructor(this)');

        containerClone.append(removeDiv);
        content.append(containerClone);

        let cloneImgDiv = containerClone.querySelector('#display-image');
        cloneImgDiv.style.backgroundImage = 'unset';

        clearValues(containerClone);
        removeInstructor();
        // } else {
        //     return 'Not all fields are filled!';
        // }
    });
}

function removeInstructor() {
    let buttons = document.querySelectorAll('.instructor-card .remove-condition');

    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            let condition = button.parentElement;
            let conditionEditorId = button.previousElementSibling.querySelector('.ql-container').getAttribute('id');
            condition.remove();

            let conditions = document.querySelectorAll('.instructor-card:not(:first-child)');
            var i = 1;

            conditions.forEach(function (condition) {
                let counter = i++;
                let instructorImg = condition.querySelector('.upload-container input');
                let instructorEditor = condition.querySelector('.ql-container');
                let editorInput = instructorEditor.nextElementSibling;
                let elementInput = editorInput.nextElementSibling;

                instructorImg.setAttribute('name', 'instructor[condition' + counter + ']' + '[img]');
                instructorEditor.setAttribute('id', 'instructor-descr' + counter);
                editorInput.setAttribute('id', 'instructor-descr' + counter);
                editorInput.setAttribute('name', 'instructor[condition' + counter + ']' + '[instructor-descr-body]');
                elementInput.setAttribute('name', 'instructor[condition' + counter + ']' + '[element-name]');
                elementInput.value = instructorEditor.getAttribute('id');
            });
        });
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

        let syllabusButton = containerClone.firstElementChild;
        let controlsDiv = document.createElement('div');
        let removeDiv = document.createElement('div');
        controlsDiv.setAttribute('class', 'controls');
        removeDiv.setAttribute('class', 'remove-condition');
        removeDiv.innerHTML = '<i class="fa fa-times" aria-hidden="true"></i>';

        containerClone.insertBefore(controlsDiv, syllabusButton);
        controlsDiv.append(removeDiv);
        container.append(containerClone);

        removeSection();
    });
}

function removeSection() {
    let buttons = document.querySelectorAll('.syllabus-content .remove-condition');

    buttons.forEach(function (button) {
        button.addEventListener('click', function() {
            let condition = button.parentElement.parentElement;
            let conditionEditorId = condition.querySelector('.panel .ql-container').getAttribute('id');
            condition.remove();

            let conditions = document.querySelectorAll('.syllabus-content:not(:first-child)');
            var i = 1;

            conditions.forEach(function (condition) {
                let counter = i++;
                let titleInput = condition.querySelector('input');
                let instructorEditor = condition.querySelector('.ql-container');
                let editorInput = instructorEditor.nextElementSibling;
                let elementInput = editorInput.nextElementSibling;

                titleInput.setAttribute('name', 'syllabus[condition' + counter + '][syllabus-name]');
                instructorEditor.setAttribute('id', 'syllabus-descr' + counter);
                editorInput.setAttribute('id', 'syllabus-descr' + counter);
                editorInput.setAttribute('name', 'syllabus[condition' + counter + ']' + '[syllabus-descr-body]');
                elementInput.setAttribute('name', 'syllabus[condition' + counter + ']' + '[element-name]');
                elementInput.setAttribute('value', 'syllabus-descr' + counter);
            });
        });
    });
}

function destroyEditorToolbars() {
    let instructorEditorToolbars = document.querySelectorAll('.instructor-new');
    instructorEditorToolbars.forEach(function (editor) {
        let oldToolbar = editor.firstElementChild;
        oldToolbar.remove();
    });

    let syllabusEditorToolbars = document.querySelectorAll('.panel .ql-toolbar:first-child');
    syllabusEditorToolbars.forEach(function (editor) {
        editor.remove();
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

window.onload = [courseEditorContent(), instructorEditorContainerNames(), syllabusEdtiorContainers(), timeRemoveButton(),skillRemoveButton(), instructorRemoveButton(), addTime(), addSkill(), addInstructor(), addSection()];
